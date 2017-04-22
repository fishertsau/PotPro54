<template id="user-template">
    <div style="display: flex;border-top:1px solid lightgrey;padding:5px 0px">
        <div style="flex:1">@{{ user.name}}</div>
        <div style="flex:1">@{{ user.address}}</div>
        <div style="flex:1">@{{ user.tel}}</div>
        <div style="flex:1">
            <button class="btn btn-sm btn-default"
                    @click.prevent="chooseUser()">選擇
            </button>
        </div>
    </div>
</template>
