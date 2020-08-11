<template>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Product Settings



                        <ul class="nav nav-tabs piflex-column flex-sm-row formtab-fixed" >
                            <li class="nav-item " v-on:click="changeTab(0)"   >
                                <a class="nav-link " :class="{
                                    'active':currentFormTab== 0
                                }" >Basic Setting</a>
                            </li>
                            <li class="nav-item ml-1" v-on:click="changeTab(1)">
                                <a class="nav-link " :class="{
                                    'active':currentFormTab== 1
                                }"  href="#">Unit Setting</a>
                            </li>
                            <li class="nav-item ml-1" v-on:click="changeTab(2)">
                                <a class="nav-link " :class="{
                                    'active':currentFormTab== 2
                                }"  href="#">Extra Fields</a>
                            </li>
                        </ul>



                    </div>





                    <div v-show="currentFormTab== 0" class="card-body">




                        <form @submit.prevent="processForm(msData.path['save.website'])">

                            <div class="row">

                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="defaultUnit">Default Product Unit </label>
                                    <select v-on:change="updateInput()" v-model="input.defaultUnit" class="form-control"  :class="{
                                                'is-valid':validateInputs.includes('defaultUnit') && !validateInputCheck('defaultUnit'),
                                                'is-invalid':validateInputs.includes('defaultUnit') && validateInputCheck('defaultUnit')
                                                }">

                                        <option v-for="unit in allUnits()" :value="unit.id">{{unit.name}}</option>

                                    </select>



                                    <div v-if="inputError.hasOwnProperty('defaultUnit')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.defaultUnit">
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
                    <div v-show="currentFormTab== 1" class="card-body">




                        <form @submit.prevent="processForm((editUnitDataPost)?msData.path['edit.units']:msData.path['save.units'],input1,'inputError1','updateAllUnits')">

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
                                    <label for="shortname">Short Name </label>
                                    <input ref="shortname"

                                           :class="{
                                                'is-valid':validateInputs.includes('shortname') && !validateInputCheck('shortname'),
                                                'is-invalid':validateInputs.includes('shortname') && validateInputCheck('shortname')
                                                }"

                                           type="text" v-model="input1.shortname" name="shortname" class="form-control" id="shortname">

                                    <div v-if="inputError1.hasOwnProperty('shortname')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError1.shortname">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="unit">Unit </label>
                                    <input ref="unit"

                                           :class="{
                                                'is-valid':validateInputs.includes('unit') && !validateInputCheck('unit'),
                                                'is-invalid':validateInputs.includes('unit') && validateInputCheck('unit')
                                                }"

                                           type="number" v-model="input1.unit" name="unit" class="form-control" id="unit">

                                    <div v-if="inputError1.hasOwnProperty('unit')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError1.unit">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>
                                <div class="form-check col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="status">Visibilty </label>
                                <div class="form-control ">

                                    <label class="radio"><input  v-model="input1.status" id="status" name="status" type="radio" value="1" ><span class="pl-2">Public</span></label>
                                    <label class="radio pl-2 "><input  v-model="input.status" name="status" type="radio" value="0"><span class="pl-2">Private</span></label>

                                </div>






                                    <div v-if="inputError1.hasOwnProperty('status')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError1.status">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>

                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="dunitId">Down Unit </label>
                                    <select v-on:change="updateInput()" v-model="input1.dunitId" class="form-control"  :class="{
                                                'is-valid':validateInputs.includes('dunitId') && !validateInputCheck('dunitId'),
                                                'is-invalid':validateInputs.includes('dunitId') && validateInputCheck('dunitId')
                                                }">
                                        <option  :value="0" selected>No Down Unit</option>
                                        <option v-for="unit in allUnits()" :value="unit.id">{{unit.name}}</option>

                                    </select>



                                    <div v-if="inputError1.hasOwnProperty('dunitId')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError1.dunitId">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>

                                <div v-show="checkisValidSelect('dunitId','dunit',input1)" class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="dunit">Down Unit Conversation</label>
                                    <input ref="dunit"

                                           :class="{
                                                'is-valid':validateInputs.includes('dunit') && !validateInputCheck('dunit'),
                                                'is-invalid':validateInputs.includes('dunit') && validateInputCheck('dunit')
                                                }"

                                           type="text" v-model="input1.dunit" name="dunit" class="form-control" id="dunit">

                                    <div v-if="inputError1.hasOwnProperty('dunit')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError1.dunit">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>



                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="uunitId">Up Unit </label>
                                    <select v-on:change="updateInput()" v-model="input1.uunitId" class="form-control"  id="uunitId" :class="{
                                                'is-valid':validateInputs.includes('uunitId') && !validateInputCheck('uunitId'),
                                                'is-invalid':validateInputs.includes('uunitId') && validateInputCheck('uunitId')
                                                }">
                                        <option  :value="0" selected>No Down Unit</option>
                                        <option v-for="unit in allUnits()" :value="unit.id">{{unit.name}}</option>

                                    </select>



                                    <div v-if="inputError1.hasOwnProperty('uunitId')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError1.uunitId">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>

                                <div  v-show="checkisValidSelect('uunitId','uunit',input1)" class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="uunit">Up Unit Conversation </label>
                                    <input ref="uunit"

                                           :class="{
                                                'is-valid':validateInputs.includes('dunit') && !validateInputCheck('dunit'),
                                                'is-invalid':validateInputs.includes('dunit') && validateInputCheck('dunit')
                                                }"

                                           type="text" v-model="input1.uunit" name="uunit" class="form-control" id="uunit">

                                    <div v-if="inputError1.hasOwnProperty('uunit')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError1.uunit">
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
                                    <div class="bg-info text-center pt-2 pb-2"> All Units </div>

                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Name</th>
                                            <th>Short Name</th>
                                            <th>Unit Rate</th>
                                            <th>Up Unit Name</th>
                                            <th>Up Unit</th>
                                            <th>Down Unit Name</th>
                                            <th>Down Unit</th>
                                            <th class="text-center">Action</th>
                                        </tr>

                                        <tr v-for="unit in allUnits()">
                                                <td>{{unit.name}}</td>
                                                <td>{{unit.shortname}}</td>
                                                <td>{{unit.unit}}</td>
                                                <td>{{unit.uunitName}}</td>
                                                <td>{{unit.uunit}}</td>
                                                <td>{{unit.dunitName}}</td>
                                                <td>{{unit.dunit}}</td>
                                                <td>

                                                    <div class="btn-group col-12" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-outline-danger" v-on:click="deleteUnit(unit)" > <i class="fa fa-trash-alt"></i></button>
                                                        <button type="button" class="btn btn-outline-info" v-on:click="editUnit(unit)"> <i class="fa fa-edit"></i></button>
                                                    </div>

                                                </td>
                                        </tr>
                                    </table>

                                </div>


                            </div>



                        </form>





                    </div>

                    <div v-show="currentFormTab== 2" class="card-body">




                        <form @submit.prevent="processForm((editFielsDataPost)?msData.path['edit.extraFields']:msData.path['save.extraFields'],input2,'inputError2','updateAllFiedsa')">

                            <div class="row">

                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="name">System Name </label>
                                    <input ref="name"

                                           :class="{
                                                'is-valid':validateInputs.includes('name') && !validateInputCheck('name'),
                                                'is-invalid':validateInputs.includes('name') && validateInputCheck('name')
                                                }"

                                           type="text" v-model="input2.name" name="name" class="form-control" id="name">

                                    <div v-if="inputError2.hasOwnProperty('name')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError2.name">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="dname">Display Text </label>
                                    <input ref="dname"

                                           :class="{
                                                'is-valid':validateInputs.includes('dname') && !validateInputCheck('dname'),
                                                'is-invalid':validateInputs.includes('dname') && validateInputCheck('dname')
                                                }"

                                           type="text" v-model="input2.dname" name="dname" class="form-control" id="dname">

                                    <div v-if="inputError2.hasOwnProperty('dname')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError2.dname">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="dvalue">Default Value </label>
                                    <input ref="dvalue"

                                           :class="{
                                                'is-valid':validateInputs.includes('dvalue') && !validateInputCheck('dvalue'),
                                                'is-invalid':validateInputs.includes('dvalue') && validateInputCheck('dvalue')
                                                }"

                                           type="text" v-model="input2.dvalue" name="dvalue"  class="form-control" id="dvalue">

                                    <div v-if="inputError2.hasOwnProperty('dvalue')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError2.dvalue">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="type">Type </label>
                                    <select v-on:change="updateInput()" id="type" name="type" v-model="input2.type" class="form-control"  :class="{
                                                'is-valid':validateInputs.includes('type') && !validateInputCheck('type'),
                                                'is-invalid':validateInputs.includes('type') && validateInputCheck('type')
                                                }">
                                        <option  value="text" selected>Text</option>
                                        <option  value="number" selected>Number</option>

                                    </select>



                                    <div v-if="inputError2.hasOwnProperty('type')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError2.type">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>
                                <div class="form-check col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="required">Required </label>
                                    <div class="form-control ">

                                        <label class="radio"><input  v-model="input2.required" id="required" name="required" type="radio" value="1" ><span class="pl-2">Mandatory </span></label>
                                        <label class="radio pl-2 "><input  v-model="input2.required" name="required" type="radio" value="0"><span class="pl-2">Optional</span></label>

                                    </div>






                                    <div v-if="inputError2.hasOwnProperty('status')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError2.status">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>
                                <div class="form-check col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="status">Active </label>
                                <div class="form-control ">

                                    <label class="radio"><input  v-model="input2.status" id="status" name="status" type="radio" value="1" ><span class="pl-2">On</span></label>
                                    <label class="radio pl-2 "><input  v-model="input2.status" name="status" type="radio" value="0"><span class="pl-2">Off</span></label>

                                </div>






                                    <div v-if="inputError2.hasOwnProperty('status')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError2.status">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>




                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="cat">Category </label>
                                    <select v-on:change="allSubCategory(input2.cat,true)" v-model="input2.cat" name="cat" class="form-control"  id="cat" :class="{
                                                'is-valid':validateInputs.includes('cat') && !validateInputCheck('cat'),
                                                'is-invalid':validateInputs.includes('cat') && validateInputCheck('cat')
                                                }">
                                        <option  :value="0" selected>All Category</option>
                                        <option v-for="unit in allCategory(false,'From Line 540')" :value="unit.id">{{unit.name}}</option>

                                    </select>



                                    <div v-if="inputError2.hasOwnProperty('cat')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError2.cat">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>

                                <div  v-show="checkisValidSelect('cat','scat',input2)" class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="scat">Sub Category </label>
                                    <select v-on:change="updateInput()" v-model="input2.scat" name="scat" class="form-control"  id="scat" :class="{
                                                'is-valid':validateInputs.includes('scat') && !validateInputCheck('scat'),
                                                'is-invalid':validateInputs.includes('scat') && validateInputCheck('scat')
                                                }">
                                        <option  :value="0" selected>All Sub Category</option>
                                        <option v-for="unit in allSubCategory(input2.cat)" :value="unit.id">{{unit.name}}</option>

                                    </select>
                                    <div v-if="inputError1.hasOwnProperty('scat')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError1.scat">
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
                                    <div class="bg-info text-center pt-2 pb-2"> All Extra Fields </div>

                                    <table class="table table-bordered">
                                        <tr>
                                             <th>System Name</th>
                                            <th>Display Name</th>
                                            <th>Type</th>
                                            <th>Default Value</th>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <th>Required</th>
                                            <th>Active</th>
                                            <th class="text-center">Action</th>
                                        </tr>

                                        <tr v-for="unit in allExtraFields()">
                                                <td>{{unit.name}}</td>
                                                <td>{{unit.dname}}</td>
                                                <td>{{unit.type}}</td>
                                                <td>{{unit.dvalue}}</td>
                                                <td>{{unit.catName}}</td>
                                                <td>{{unit.scatName}}</td>
                                                <td>
                                                    <i class="fa fa-check text-success" v-show="unit.required"></i>
                                                    <i class="fa fa-times text-danger"  v-show="!unit.required"></i>
                                                </td>
                                                <td>
                                                    <i class="fa fa-check text-success" v-show="unit.status"></i>
                                                    <i class="fa fa-times text-danger"  v-show="!unit.status"></i>
                                                </td>

                                                <td>

                                                    <div class="btn-group col-12" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-outline-danger" v-on:click="deleteExtra(unit)" > <i class="fa fa-trash-alt"></i></button>
                                                        <button type="button" class="btn btn-outline-info" v-on:click="editExtra(unit)"> <i class="fa fa-edit"></i></button>
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
        name: "product",
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
                editUnitDataPost:false,
                allExtraFieldsFromServer:null,
                allCategoryFromServer:null,
                allSubCategoryFromServer:null,
                editFielsDataPost:false,
                getingCat:false,
                getingSubCat:false,
                getingExtra:false,
                getingUnit:false


            }
        },
        props: ['msData'],
        created() {

            if(this.msData.hasOwnProperty('inputData'))this.input=this.msData.inputData;
            this.updateInput();
            this.input1.dunitId=0;
            this.input1.uunitId=0;

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
            deleteExtra(unit){

                var url=this.msData.path['delete.extraFields'];
                var data={};
                data.id=unit.id;

                if (confirm("Are you sure, You want to delete "+unit.name+"?") == true){

                    if(!this.editFielsDataPost)this.editFielsDataPost=true;
                }

                this.processForm(url,data,{},'updateAllFiedsa');


            },
            editUnit(unit){
                this.input1=unit;
                document.body.scrollTop = 0; // For Safari
                document.documentElement.scrollTop = 0;

                Vue.toasted.success("Edit unit: "+unit.name,{duration:1000});
                if(!this.editUnitDataPost)this.editUnitDataPost=true;

            },
            editExtra(unit){
                this.input2=unit;
                document.body.scrollTop = 0; // For Safari
                document.documentElement.scrollTop = 0;

                Vue.toasted.success("Edit unit: "+unit.name,{duration:1000});
                if(!this.editFielsDataPost)this.editFielsDataPost=true;

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
            updateAllFiedsa(){
                this.input2={};
                this.inputError2={};
                this.allExtraFields(true);
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
