<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Mange Categories






                    </div>





                    <div v-show="currentFormTab== 0" class="card-body">




                        <form @submit.prevent="processForm((editCatDataPost)?msData.path['edit.units']:msData.path['save.cat'],input1,'inputError1','updateAllcategory')">

                            <div class="row">

                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="name">Name </label>
                                    <input ref="name"

                                           :class="{
                                                'is-valid':validateInputs.includes('name') && !validateInputCheck('name'),
                                                'is-invalid':validateInputs.includes('name') && validateInputCheck('name')
                                                }"

                                           type="text" v-model="input1.name" name="name" class="form-control" id="name">

                                    <div v-if="inputError1.hasOwnProperty('name')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError1.name">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>






                            </div>

                            <div class="mt-3">

                                <input type="submit" class="btn btn-secondary col-12"  name="submit">

                            </div>


                            <div class="row mt-3">

                                <div class="col-12">
                                    <div class="bg-info text-center pt-2 pb-2"> All Product Categories </div>

                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Name</th>
                                            <th class="text-center">Action</th>
                                        </tr>

                                        <tr v-for="unit in allCategory()">

                                            <td>{{unit.name}}</td>

                                            <td>

                                                <div class="btn-group col-12" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-outline-danger" v-on:click="deletecat(unit)" > <i class="fa fa-trash-alt"></i></button>
                                                    <button type="button" class="btn btn-outline-info" v-on:click="editUnit(unit)"> <i class="fa fa-edit"></i></button>
                                                </div>

                                            </td>
                                        </tr>
                                    </table>

                                </div>


                            </div>



                        </form>





                    </div>


                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

    export default {
        name: "category",
        props: ['msData'],
        data(){
            return {


                input1: {},
                inputError1: {},

                validateInputs: ['CompanyName'],
                validationRules:{
                    'CompanyName':{ presence: {allowEmpty: false}}
                },
                currentFormTab:0,
                allUnitsFromServer:{},
                editCatDataPost:false,
                allExtraFieldsFromServer:null,
                allCategoryFromServer:null,
                allSubCategoryFromServer:null,
                editFielsDataPost:false,

            }


        },
        beforeMount() {
            this.allCategory();
        },
        methods:{
            deletecat(unit){
                var data={};
                data.id=unit.id;
                var url=this.msData.path['delete.cat'];

                if (confirm("Are you sure, You want to delete "+unit.name+"?") == true){

                    this.processForm(url,data,{},'updateAllcategory');
                }




            },
            allUnits(){
                return this.allUnitsFromServer;
            },
            validateInputCheck(name, data = null) {
                var er = true;

                var input = (data == null) ? this.input : data;
                var validatedData = window.validate.single(input[name],this.validationRules[name]);
                if (er && validatedData === undefined) er = false;
                //   console.log(er);
                return er;
            },
            updateAllcategory(){
                this.input1={};
                this.inputError1={};
                this.allCategory(true);
            }
            ,restForm(){

        },
            allCategory(forced=false){
                var url=this.msData.path['get.allCat'];
                var th=this;



                if(th.allCategoryFromServer==null ||  forced)axios.post(url).then(function (res) {

                    th.allCategoryFromServer=res.data.ResponseData;


                });

                return th.allCategoryFromServer;

            }, updateInput() {
                var oldInput = this.input1;
                this.input1 = null;
                this.input1 = oldInput;
            },
            updateError() {
                var oldInput = this.inputError1;
                this.inputError1 = null;
                this.inputError1 = oldInput;
            }
            ,
            processForm(url,input=this.input,error='inputError',callback=null) {
                var th = this;
                this[error] = {};

                axios.post(url, input).then(function (res) {
                    var data = res.data;

                    Vue.toasted.success(data.msg,{duration:1000});

                    if(data.hasOwnProperty('ResponseMessage') && typeof data.ResponseMessage == "array")Vue.toasted.success(data.ResponseMessage[0],{duration:1000});
                    if(callback!=null)th[callback]();
                    if(data.hasOwnProperty('nextUrl')){
                        window.VueApp.clickEventFromSideBar(data.nextUrl);
                    }
                }).catch(
                    function (e) {

                        th[error] = e.response.data.errors;
                        Vue.toasted.error(e.response.data.message,{duration:1000});
                        th.updateError();
                    }
                ).then(function(){
                    th.restForm();
                });
                //  alert(url)

            },
        }
    }
</script>

<style scoped>

</style>
