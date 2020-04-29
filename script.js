Vue.component('records-item', {
    props: ['record'],
    template: 
        '<div class="records__record">'+
            '<div class="records__record-header">'+
                '<div class="records__record-id">#{{ record.ID }}</div>'+
                '<div class="records__record-date">{{ record.DATE_CREATE }}</div>'+
                '<div class="records__record-name">Пользователь: {{ record.NAME }}</div>'+
            '</div>'+
            '<div class="records__record-body">'+
                '<div class="records__record-comment">{{ record.COMMENT }}</div>'+
                '<div v-if="record.FILE != 0" class="records__record-file">Файл: <a target="_blank" :href="record.FILE.SRC">{{ record.FILE.NAME }}</a></div>'+
            '</div>'+
        '</div>'        
})

var guestBook = new Vue({
    //this targets the div id app
    el: '#guestbook',
    data() {
        return {
            name: '', //this stores data values for ‘name’
            comment: '', //this stores data values for comment,
            file:'',
            records: [], //stores axios response
            isFIle: false
        }
    },
    mounted() {
        this.name = this.$el.querySelector('input[name="NAME"]').attributes['value'].value;
        this.getRecords();
    },
    methods:{
        submitForm: function(e){
            e.preventDefault();
            
            let fd = new FormData();
            fd.append('NAME',this.name);
            fd.append('COMMENT',this.comment);
            fd.append('FILE',this.file = this.$refs.file.files[0]);
            axios({
                method: 'post',
                url: '/loadData/addRecord.php',
                data: fd
            })
            .then(response => ((response.data) ? this.records.unshift(response.data) : false))
            .catch(function (error) {
                console.log(error);
            });
        },
        getRecords: function() {
            axios({
                method: 'post',
                url: '/loadData/getRecords.php'
            })
            .then(response => (this.records = response.data))
            .catch(function (error) {
                console.log(error);
            });
        }
    }
})