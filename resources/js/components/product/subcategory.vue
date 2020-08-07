<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Mange Sub Categories






                    </div>





                    <div v-show="currentFormTab== 0" class="card-body">




                        <form @submit.prevent="processForm((editCatDataPost)?msData.path['edit.scat']:msData.path['save.scat'],input1,'inputError1','updateAllSubcategory')">

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


                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="ParentCategoryId">Parent Category </label>
                                    <select v-on:change="allSubCategory(input1.ParentCategoryId,true)" v-model="input1.ParentCategoryId" name="ParentCategoryId" class="form-control"  id="ParentCategoryId" :class="{
                                                'is-valid':validateInputs.includes('ParentCategoryId') && !validateInputCheck('ParentCategoryId'),
                                                'is-invalid':validateInputs.includes('ParentCategoryId') && validateInputCheck('ParentCategoryId')
                                                }">

                                        <option v-for="unit in allCategory()" :value="unit.id">{{unit.name}}</option>

                                    </select>



                                    <div v-if="inputError1.hasOwnProperty('cat')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError1.cat">
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
                                    <div class="bg-info text-center pt-2 pb-2"> All Product Sub Categories </div>

                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Name</th>
                                            <th>Parent Category</th>
                                            <th class="text-center">Action</th>
                                        </tr>

                                        <tr v-for="unit in allSubCategory()">

                                            <td>{{unit.name}}</td>
                                            <td>{{unit.catName}}</td>

                                            <td>

                                                <div class="btn-group col-12" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-outline-danger" v-on:click="deletecat(unit)" > <i class="fa fa-trash-alt"></i></button>
                                                    <button type="button" class="btn btn-outline-info" v-on:click="editCat(unit)"> <i class="fa fa-edit"></i></button>
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
    export default {
        name: "subcategory",
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
            editCat(unit){

                this.input1=unit;
                document.body.scrollTop = 0; // For Safari
                document.documentElement.scrollTop = 0;

                Vue.toasted.success("Edit Sub Category: "+unit.name,{duration:1000});
                if(!this.editCatDataPost)this.editCatDataPost=true;
            },
            deletecat(unit){
                var data={};
                data.id=unit.id;
                var url=this.msData.path['delete.scat'];

                if (confirm("Are you sure, You want to delete "+unit.name+"?") == true){

                    this.processForm(url,data,{},'updateAllSubcategory');
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
            },
            updateAllSubcategory(){
                this.input1={};
                this.inputError1={};
                this.allSubCategory(true);
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

            },
            allSubCategory(forced=false){
                var url=this.msData.path['get.allSubCat'];
                var th=this;



                if(th.allSubCategoryFromServer==null ||  forced)axios.post(url).then(function (res) {

                    th.allSubCategoryFromServer=res.data.ResponseData;


                });

                return th.allSubCategoryFromServer;

            },


            updateInput() {
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
