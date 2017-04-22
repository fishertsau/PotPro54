<template id="sales-list-content">
    <div style="display:flex">
        <div style="flex:1">姓名</div>
        <div style="flex:1">Email</div>
        <div style="flex:1">電話</div>
        <div style="flex:1">選擇</div>
    </div>
    <user-item v-for="user in list" :user="user" :chosen.sync="chosen"></user-item>
</template>
