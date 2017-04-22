<div v-show="showNote"
     class="inputNote animated"
     transition='fade'>
    <span class="pull-right">
    <button class="btn btn-warning" @click.prevent='showNote=false'>
        <i class="fa fa-times" aria-hidden="true"></i>&nbsp;收起
    </button>
    </span>
    <ul style="list-style-type: disc;">
        <li>
            數量設定:
            <ul>
                <li>若選擇<span style="color: #ff0000;">允許</span>時,只能設定一個加工選項</li>
            </ul>
        </li>
        <br/>
        <li>加工選項 "編號":
            <ul>
                <li>號碼不得空白,<span style="color: #ff0000;">不得重複<span
                                style="color: #000000;">.</span></span></li>
                <li><span style="color: #000000;"><span style="color: #ff0000;"><span
                                    style="color: #000000;">號碼開頭.一律為大寫英文字母.</span></span></span></li>
                <li>號碼只能用大寫英文字母或是數字.</li>
            </ul>
        </li>
    </ul>
</div>
