<div>

    <br>
    <button class="btn btn-primary full-width"
            @click.prevent="popupExampleCreateFormModal">
        <i class="fa fa-flag" aria-hidden="true"></i>&nbsp;
        新增案例
    </button>


    @include('frontEnd.sales.example._exampleFilter')
    <br>
    <div id="exampleListContent"
         class="app-exampleContent"
         v-show="exampleListShow"></div>

    <div v-show="!exampleListShow" class="app-orderContent">
        <button class="btn btn-primary full-width"
        @click="exampleListShow=true">
        <i class="fa fa-reply" aria-hidden="true"></i>&nbsp;
        返回案例清單
        </button>
        <br/>
        <hr class="black-horizontal-line">
        <div id="exampleContent"></div>
    </div>
</div>

<!-- creation form modal : The confirm info is put here.-->
@include('frontEnd.sales.example._createExampleFormModal')