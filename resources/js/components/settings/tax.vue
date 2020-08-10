<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tax Settings



                        <ul class="nav nav-tabs piflex-column flex-sm-row formtab-fixed" >
                            <li class="nav-item " v-on:click="changeTab(0)"   >
                                <a class="nav-link " :class="{
                                    'active':currentFormTab== 0
                                }" >Manage Taxes</a>
                            </li>
                            <li class="nav-item ml-1" v-on:click="changeTab(1)">
                                <a class="nav-link " :class="{
                                    'active':currentFormTab== 1
                                }"  href="#">GST Codes</a>
                            </li>

                        </ul>



                    </div>





                    <div v-show="currentFormTab== 0" class="card-body">




                        <form @submit.prevent="processForm((editTaxDataPost)?msData.path['edit.Tax']:msData.path['save.Tax'],input1,'inputError1','updateAllTax')">

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
                                <div class="form-check col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="status">Status </label>
                                    <div class="form-control ">

                                        <label class="radio"><input  v-model="input1.status" id="status" name="status" type="radio" value="1" ><span class="pl-2">
                                            <i class="fa fa-check text-success" ></i>
                                        </span></label>

                                        <label class="radio pl-2 "><input  v-model="input.status" name="status" type="radio" value="0"><span class="pl-2">    <i class="fa fa-times text-danger"  ></i></span></label>

                                    </div>






                                    <div v-if="inputError1.hasOwnProperty('status')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError1.status">
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
                                    <div class="bg-info text-center pt-2 pb-2"> All Taxes </div>

                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Name</th>
                                            <th>Status</th>

                                            <th class="text-center">Action</th>
                                        </tr>

                                        <tr v-for="unit in allTaxes()">
                                            <td>{{unit.name}}</td>
                                            <td>
                                                <i class="fa fa-check text-success" v-show="unit.status"></i>
                                                <i class="fa fa-times text-danger"  v-show="!unit.status"></i>
                                            </td>
                                            <td>

                                                <div class="btn-group col-12" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-outline-danger" v-on:click="deleteTax(unit)" > <i class="fa fa-trash-alt"></i></button>
                                                    <button type="button" class="btn btn-outline-info" v-on:click="editTax(unit)"> <i class="fa fa-edit"></i></button>
                                                </div>

                                            </td>
                                        </tr>
                                    </table>

                                </div>


                            </div>



                        </form>





                    </div>
                    <div v-show="currentFormTab== 1" class="card-body">




                        <form @submit.prevent="processForm((editTaxCodesDataPost)?msData.path['edit.TaxCodes']:msData.path['save.TaxCodes'],input2,'inputError2','updateAllTaxCodes')">

                            <div class="row">

                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="code">Code</label>
                                    <input ref="code"

                                           :class="{
                                                'is-valid':validateInputs.includes('code') && !validateInputCheck('code'),
                                                'is-invalid':validateInputs.includes('code') && validateInputCheck('code')
                                                }"

                                           type="number" v-model="input2.code" name="code" class="form-control" id="code">

                                    <div v-if="inputError2.hasOwnProperty('code')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError2.code">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>

                            </div>
                            <div class="row">

                                <div class="form-group col-xs-12 col-sm-12 col-md-2 col-lg-2" v-for="tax in allTaxes()">
                                    <label :for="tax.name">{{tax.name}}</label>
                                    <input :ref="tax.name"

                                           :class="{
                                                'is-valid':validateInputs.includes('code') && !validateInputCheck('code'),
                                                'is-invalid':validateInputs.includes('code') && validateInputCheck('code')
                                                }"

                                           type="number" v-model="input2[tax.name]" :name="tax.name" class="form-control" :id="tax.name">

                                    <div v-if="inputError2.hasOwnProperty(tax.name)">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError2[tax.name]">
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
                                    <div class="bg-info text-center pt-2 pb-2"> All Codes </div>

                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Code</th>
                                            <th v-for="tax in allTaxes()">{{tax.name}}</th>
                                            <th class="text-center">Action</th>
                                        </tr>

                                        <tr v-for="unit in allTaxeCodes()">
                                            <td>{{unit.code}}</td>
                                            <td v-for="tax in allTaxes()">{{ unit[tax.name]}}</td>
                                            <td>

                                                <div class="btn-group col-12" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-outline-danger" v-on:click="deleteTaxCodes(unit)" > <i class="fa fa-trash-alt"></i></button>
                                                    <button type="button" class="btn btn-outline-info" v-on:click="editTaxCode(unit)"> <i class="fa fa-edit"></i></button>
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
        name: "tax",
        data() {
            return {
                editor: ClassicEditor,
                editorConfig: {
                    // The configuration of the editor.
                },
                input: {},
                inputError: {},
                input1: {},
                inputError1: {},
                input2: {},
                inputError2: {},
                validateInputs: ['CompanyName'],
                validationRules:{
                    'CompanyName':{ presence: {allowEmpty: false}}
                },
                currentFormTab:0,
                allUnitsFromServer:null,
                allTaxesFromServer:null,
                editUnitDataPost:false,
                editTaxDataPost:false,
                allExtraFieldsFromServer:null,
                allCategoryFromServer:null,
                allSubCategoryFromServer:null,
                allTaxesCodesFromServer:null,
                editFielsDataPost:false,
                getingCat:false,
                getingSubCat:false,
                getingExtra:false,
                getingUnit:false,
                editTaxCodesDataPost:false


            }
        },
        props: ['msData'],
        created() {

            if(this.msData.hasOwnProperty('inputData'))this.input=this.msData.inputData;
            this.updateInput();
          //  this.input2.tax={};


        },
        beforeMount() {


        }
        ,
        methods: {
            deleteUnit(unit){

                var url=this.msData.path['delete.units'];
                var data={};
                data.id=unit.id;

                if (confirm("Are you sure, You want to delete "+unit.name+"?") == true){

                    if(!this.editUnitDataPost)this.editUnitDataPost=true;
                }

                this.processForm(url,data,{},'updateAllUnits');


            },
            deleteTax(unit){

                var url=this.msData.path['delete.Tax'];
                var data={};
                data.id=unit.id;

                if (confirm("Are you sure, You want to delete "+unit.name+"?") == true){

                    console.log('triggers');
                    if(!this.allTaxesFromServer)this.allTaxesFromServer=true;
                    this.processForm(url,data,{},'updateAllTax');
                }




            },
            deleteExtra(unit){

                var url=this.msData.path['delete.extraFields'];
                var data={};
                data.id=unit.id;

                if (confirm("Are you sure, You want to delete "+unit.name+"?") == true){

                    if(!this.editFielsDataPost)this.editFielsDataPost=true;
                }

                this.processForm(url,data,{},'updateAllFiedsa');


            },
            deleteTaxCodes(unit){

                var url=this.msData.path['delete.TaxCodes'];
                var data={};
                data.id=unit.id;

                if (confirm("Are you sure, You want to delete "+unit.code+"?") == true){

                    if(!this.editTaxCodesDataPost)this.editTaxCodesDataPost=false;
                }

                this.processForm(url,data,{},'updateAllTaxCodes');


            },
            editUnit(unit){
                this.input1=unit;
                document.body.scrollTop = 0; // For Safari
                document.documentElement.scrollTop = 0;

                Vue.toasted.success("Edit unit: "+unit.name,{duration:1000});
                if(!this.editUnitDataPost)this.editUnitDataPost=true;

            },
            editTax(unit){
                this.input1=unit;
                document.body.scrollTop = 0; // For Safari
                document.documentElement.scrollTop = 0;

                Vue.toasted.success("Edit Tax: "+unit.name,{duration:1000});
                if(!this.editTaxDataPost)this.editTaxDataPost=true;

            },
            editExtra(unit){
                this.input2=unit;
                document.body.scrollTop = 0; // For Safari
                document.documentElement.scrollTop = 0;

                Vue.toasted.success("Edit unit: "+unit.name,{duration:1000});
                if(!this.editFielsDataPost)this.editFielsDataPost=true;

            },
            editTaxCode(unit){
                this.input2=unit;
                document.body.scrollTop = 0; // For Safari
                document.documentElement.scrollTop = 0;

                Vue.toasted.success("Edit GST Code: "+unit.code,{duration:1000});
                if(!this.editTaxCodesDataPost)this.editTaxCodesDataPost=true;

            },
            checkisValidSelect(type,current,input=this.input){

                var check=input[type] == 0;
                if(check && input.hasOwnProperty(current)){
                    input[current]="";
                }

                return (check)? false:true;
            },

            changeTab(tab){
                if(this.currentFormTab!=tab)this.currentFormTab=tab;
            },
            validateInput(name, data = null) {
                var er = true;

                var input = (data == null) ? this.input : data;
                var validatedData = window.validate.single(input[name], this.validationRules[name]);
                if (er && validatedData === undefined) er = false;
                if (er) {
                    if(!this.inputError.hasOwnProperty(name))this.inputError[name]=[];
                    this.inputError[name].push(validatedData);}
                return er;
            },

            validateInputCheck(name, data = null) {
                var er = true;

                var input = (data == null) ? this.input : data;
                var validatedData = window.validate.single(input[name],this.validationRules[name]);
                if (er && validatedData === undefined) er = false;
                //   console.log(er);
                return er;
            },

            updateAllUnits(){
                this.input1={};
                this.inputError1={};

                this.allUnits(true);
            },
            updateAllTax(){
                this.input1={};
                this.inputError1={};

                this.allTaxes(true);
            },
            updateAllTaxCodes(){
                this.input2={};
                this.inputError2={};

                this.allTaxeCodes(true);
            },

            restForm(){
                if(this.editUnitDataPost)this.editUnitDataPost=false;
                if(this.editFielsDataPost)this.editFielsDataPost=false;
            },

            processForm(url,input=this.input,error='inputError',callback=null) {
                var th = this;
                this[error] = {};

                axios.post(url, input).then(function (res) {
                    var data = res.data;

                   if(data.hasOwnProperty('msg')) Vue.toasted.success(data.msg,{duration:1000});

                    if(data.hasOwnProperty('ResponseMessage') )Vue.toasted.success(data.ResponseMessage[0],{duration:1000});
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
            fileInput(e, inputName) {

                const file = e.target.files;
                let reader = new FileReader;
                reader.onload = e => {
                    this.input[inputName] = e.target.result
                    this.updateInput();
                }
                reader.readAsDataURL(file[0])


                // console.log(file[0])


            },

            updateInput() {
                var oldInput = this.input;
                this.input = null;
                this.input = oldInput;
            },
            updateError() {
                var oldInput = this.inputError;
                this.inputError = null;
                this.inputError = oldInput;
            },


            allUnits(forced=false){
                var url=this.msData.path['get.allUnits'];
                var th=this;



                if((th.allUnitsFromServer==null && !th.getingUnit) ||  forced){
                    th.getingUnit=true;
                    axios.post(url).then(function (res) {

                        th.allUnitsFromServer=res.data.ResponseData;

                    }).catch().then(function () {
                        th.getingUnit=false;
                    });
                }

                return th.allUnitsFromServer;



            },


            allTaxes(forced=false){
                var url=this.msData.path['get.allTaxes'];
                var th=this;



                if((th.allTaxesFromServer==null && !th.getingUnit) ||  forced){
                    th.getingUnit=true;
                    axios.post(url).then(function (res) {

                        th.allTaxesFromServer=res.data.ResponseData;

                    }).catch().then(function () {
                        th.getingUnit=false;
                    });
                }

                return th.allTaxesFromServer;



            },
            allTaxeCodes(forced=false){
                var url=this.msData.path['get.allTaxesCodes'];
                var th=this;



                if((th.allTaxesCodesFromServer==null && !th.getingUnit) ||  forced){
                    th.getingUnit=true;
                    axios.post(url).then(function (res) {

                        th.allTaxesCodesFromServer=res.data.ResponseData;

                    }).catch().then(function () {
                        th.getingUnit=false;
                    });
                }

                return th.allTaxesCodesFromServer;



            },

            allExtraFields(forced=false){
                var url=this.msData.path['get.allExtra'];
                var th=this;



                if((th.allExtraFieldsFromServer==null && !th.getingExtra) ||  forced){

                    th.getingExtra=true;
                    axios.post(url).then(function (res) {

                        th.allExtraFieldsFromServer=res.data.ResponseData;


                    }).catch().then(function () {
                        th.getingExtra=false;
                    });
                }

                return th.allExtraFieldsFromServer;



            },

            allCategory(forced=false,fromPlaace=null){
                var url=this.msData.path['get.allCat'];
                var th=this;
                var rootAp=window.VueApp;


                if((th.allCategoryFromServer==null && !th.getingCat ) ||  forced){
                    th.getingCat=true;

                    axios.post(url).then(function (res) {
                        th.allCategoryFromServer=res.data.ResponseData;
                    }).catch(function (e) {

                    }).then(function () {
                        th.getingCat=false;
                        //   console.log( window.VueApp.getGlob('allCategories'));
                    });

                }


                return th.allCategoryFromServer;

            },
            allSubCategory(parentId,forced=false){
                var url=this.msData.path['get.allSCat'];
                var th=this;

                var data={
                    id:parentId,
                };

                if(( !th.getingSubCat &&th.allSubCategoryFromServer==null && this.input2.hasOwnProperty('cat') && (this.input2.cat!=null||this.input2.cat!=0 )) ||  forced){
                    th.getingSubCat=true;
                    axios.post(url,data).then(function (res) {
                        console.log('Api Call');
                        th.allSubCategoryFromServer=res.data.ResponseData;


                    }).catch(function (e) {
                        th.allSubCategoryFromServer=[];
                    }).then(function () {
                        th.getingSubCat=false;
                    });
                }

                return th.allSubCategoryFromServer;

            }
        },
        watch: {
            input(newVal) {
                // console.log('input changes');

                for (var k in newVal) {

                    if (this.inputError.hasOwnProperty(k) && this.validateInput(k, newVal)) {


                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>
