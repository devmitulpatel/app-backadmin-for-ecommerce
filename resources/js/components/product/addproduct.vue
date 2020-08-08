<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Add Proudct






                    </div>





                    <div v-show="currentFormTab== 0" class="card-body">




                        <form @submit.prevent="processForm((editCatDataPost)?msData.path['edit.cat']:msData.path['save.cat'],input1,'inputError1','updateAllcategory')">

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
                                    <label for="name">Description</label>
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
                                    <label for="name">Sell Price</label>
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
                                    <label for="name">Seller Name</label>
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
                                    <label for="name">Opening Stock</label>
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
                                    <label for="name">Discount</label>
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



                        </form>





                    </div>


                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "addproduct",
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
                getingCat:false

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

                Vue.toasted.success("Edit Category: "+unit.name,{duration:1000});
                if(!this.editCatDataPost)this.editCatDataPost=true;
            },
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



                if(th.allCategoryFromServer==null ||  forced){
                    th.getingCat=true;
                    axios.post(url).then(function (res) {

                        th.allCategoryFromServer=res.data.ResponseData;


                    }).catch().then(function () {
                        th.getingCat=false;
                    });
                }

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
