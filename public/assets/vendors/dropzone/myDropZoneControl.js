function updateDropzoneControlInfo(productBlock, _newId) {
    //抓 dropzone 的 input control element
    var infoNode = productBlock.find('.dz-nodeInfo');
    infoNode.attr('entryId', _newId);

    var _nodeId = infoNode.attr('belongsTo') + infoNode.attr('entryId');

    //把所有與這個Dropzone有關的 element, 設定新的id, 以方便之後控制,如顯示
    // (1)image id, (2)loading message id, (3)delBtn information
    //Do the necssary setting
    var dropzoneId = 'dz-SingleUpload-' + _nodeId;
    var imgId = 'dz-photo-' + _nodeId;
    var loadingMessageId = 'dz-loading-' + _nodeId;
    var delBtnId = 'dz-deleteBtn-' + _nodeId;

    var imgView = productBlock.find('.dz-photo');
    imgView.attr('id', imgId);

    var loadingView = productBlock.find('.dz-loading');
    loadingView.attr('id', loadingMessageId);

    var delButton = productBlock.find('.dz-deleteBtn');
    delButton.attr('id', delBtnId);
    delButton.css('display', 'none');

    var dropzoneNode = productBlock.find('.dropzone');
    dropzoneNode.attr('id', dropzoneId);

    return dropzoneNode;
}

/***
 *  Create the options for single upload dropzone
 *  The return value is an object containing the options
 * */
function SingleUploadDropZoneOptions(dropzoneNode) {

    //Fetch the data for the designated Node for control
    var infoNode = dropzoneNode.parent().find('.dz-nodeInfo');

    var table = infoNode.attr('belongsTo');
    var id = infoNode.attr('entryId');
    var foreignTable = infoNode.attr('foreignTable');
    var foreignKey = infoNode.attr('foreignKey');

    var _nodeId = table + id;

    //Do the necessary setting
    var sendSingleDropzoneUrlTo = '/coverPhoto/' + table + '/' + id;
    var imgId = 'dz-photo-' + _nodeId;
    var loadingMessageId = 'dz-loading-' + _nodeId;
    var delBtnId = 'dz-deleteBtn-' + _nodeId;

    var options =
    {
        url: sendSingleDropzoneUrlTo,
        maxFiles: 1,
        paramName: 'coverPhoto_file',
        maxFilesize: 5, //3M
        acceptedFiles: '.jpg, .jpeg, .png, .bmp',
        dictDefaultMessage: "上傳圖片",
        dictRemoveFile: '刪除圖片',
        addRemoveLinks: true,
        init: function () {
            this.on("sending", function (file, xhr, data) {
                data.append("_token", $('input[name=_token]').val());
                data.append("foreignTable", foreignTable);
                data.append("foreignKey", foreignKey);
                loadStart(loadingMessageId);
            });
            this.on("maxfilesexceeded", function (file) {
                this.removeAllFiles();
                this.addFile(file);
            });
            this.on("removedfile", function (file) {
            });
        },
        success: function (file, response) {

            //有可能回傳 [filename,id] 或是 filename
            //其中 id為新增 item的 id
            var newFilename = (typeof(response) == 'object') ? response[0] : response;

            var newImageSrc = '/assets/images/cover/' + newFilename;
            loadStop(loadingMessageId);
            $('#' + imgId).attr('src', newImageSrc);
            $('#' + delBtnId).css('display', 'inline');

            //若 reponse type is object, 表示有新的db entry產生, 需要更新所有相關資料
            if (typeof(response) == 'object') {

                var targetBlock = '#' + dropzoneNode.closest('.exampleProductBlock').attr('id');
                var productBlock = $(targetBlock);

                productBlock.find('.productId').val(response[1]);

                dropzoneNode = productBlock.find('.dz-SingleUpload');

                //將原有的 node 刪除
                var newDropzoneNode = dropzoneNode.clone();
                newDropzoneNode.insertAfter(dropzoneNode);
                $('#' + dropzoneNode.attr('id')).remove();

                //將新的node 變成 dropzone instance
                newDropzoneNode = updateDropzoneControlInfo(productBlock, response[1]);
                newDropzoneNode.dropzone(SingleUploadDropZoneOptions(newDropzoneNode));

                //把deleteBtn 顯示出來
                newDropzoneNode.closest('.dz-photo_block').find('.dz-deleteBtn').css('display', 'inline');
            }

        },
        error: function (file, response) {
            file.previewElement.classList.add("dz-error");
        },
        accept: function (file, done) {
            done();
        }
    };

    return options;
}


/*************coverPhoto Handler__start******************/
function deleteCoverPhoto(elem) {

    var yesDeletePhoto = confirm('確定刪除圖片?');
    if (!yesDeletePhoto) {
        return false;
    }

    var infoNode = elem.parentNode.querySelector('.dz-nodeInfo');

    //Config next step setting
    var id = infoNode.getAttribute('entryId');
    var associatedTable = infoNode.getAttribute('belongsTo');

    //url for ajax
    var sendCommandTo = "/coverPhoto/" + associatedTable + '/' + id;

    //image holder for the deleted node
    var imgId = 'dz-photo-' + associatedTable + id;
    var delBtnId = 'dz-deleteBtn-' + associatedTable + id;

    $.ajax(
        {
            url: sendCommandTo,
            type: 'DELETE',
            data: {
                '_token': $('input[name=_token]').val()
            },

            success: function (result) {
                setCoverPhotoToDefault(imgId, delBtnId);
            },

            error: function (responseTxt, statusTxt, xhr) {
                alert("Error: " + xhr.status + ": " + xhr.statusText);
            }
        }
    );
}

function setCoverPhotoToDefault(imgId, delBtnId) {
    $('#' + imgId).attr('src', '/assets/images/cover/coverPhoto.jpg');
    $('#' + delBtnId).css('display', 'none');
}


function loadStart(loadingMessageId) {
    $('#' + loadingMessageId).show();
}
function loadStop(loadingMessageId) {
    $('#' + loadingMessageId).hide();
}


$(function () {
    var token = $('input[name=_token]').val();

    /***photo handler __start  DropZone  ***/
    /*** The dropzone instance should be initiated after the document  is ready***/
    Dropzone.autoDiscover = false; //set to false, otherwise it will search dropzone twice
    //Dropzone upload for multiple files at the same time
    var DropzoneUrl = $("#dropZoneUpload").attr('data-url');
    var DropZoneOptions = {
        url: DropzoneUrl,
        paramName: 'photo',
        maxFilesize: 5, //3M
        acceptedFiles: '.jpg, .jpeg, .png, .bmp',
        dictDefaultMessage: "上傳圖片",
        dictRemoveFile: '刪除圖片',
        addRemoveLinks: true,
        maxFiles: 100,
        clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
        init: function () {
            this.on("sending", function (file, xhr, data) {
                data.append("_token", token);
            });

            this.on("maxfilesexceeded", function (file) {
                this.removeAllFiles();
                this.addFile(file);
            });

            this.on("removedfile", function (file) {

                var id = file.previewElement.querySelector(".dz-details").innerHTML;

                $.ajax({
                    type: 'DELETE',
                    url: '/photo/' + id,
                    data: {'_token': $('input[name=_token]').val()},
                    dataType: 'html',
                    success: function (data) {
                        console.log(data);
                    }
                });
            });
        },
        success: function (file, response) {
            var args = Array.prototype.slice.call(arguments);
            file.previewElement.querySelector(".dz-details").style.opacity = "0";
            file.previewElement.classList.add("dz-success");
            file.previewElement.querySelector(".dz-details").innerHTML = args[1]; //arg[1]: server response message
            console.log(response);
        },
        error: function (file, response) {
            file.previewElement.classList.add("dz-error");
        },
        accept: function (file, done) {
            done();
        }
    };
    $("#dropZoneUpload").dropzone(DropZoneOptions);

    //photo is stored at the designated place
    //Dropzone upload for ONLY one file at the same time
    //Single photo for one div/element
    //One-to-One
    var singleUploadDropzone = $('.dz-SingleUpload');
    var i;
    for (i = 0; i < singleUploadDropzone.length; i++) {
        var dropzoneNode = $('#' + singleUploadDropzone[i].id);
        dropzoneNode.dropzone(SingleUploadDropZoneOptions(dropzoneNode));
    }
    /***photo handler __end   DropZone  ***/


    /*** photo handler***/
        //Photo is deleted when button clicked and confirmed
    $('.deletePhotoBtn').click(function () {
        var yesDeletePhoto = confirm('確定刪除圖片?');
        if (yesDeletePhoto) {

            var photoId = $(this).attr('photoId');

            $.ajax(
                {
                    url: "/photo/" + photoId,
                    type: 'delete',
                    data: {
                        '_token': $('input[name=_token]').val(),
                    },
                    success: function (result) {
                        $('#photoId_' + photoId).remove();
                    },
                    error: function (responseTxt, statusTxt, xhr) {
                        alert("Error: " + xhr.status + ": " + xhr.statusText);
                    }
                }
            );
        }
    });
});
/*************coverPhoto Handler__endt******************/

