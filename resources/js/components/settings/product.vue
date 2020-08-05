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
                        </ul>



                    </div>





                    <div v-show="currentFormTab== 0" class="card-body">




                        <form @submit.prevent="processForm(msData.path['save.website'])">

                            <div class="row">

                                <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <label for="title">Title </label>
                                    <input ref="title"

                                           :class="{
                                                'is-valid':validateInputs.includes('title') && !validateInputCheck('title'),
                                                'is-invalid':validateInputs.includes('title') && validateInputCheck('title')
                                                }"

                                           type="text" v-model="input.title" name="title" class="form-control" id="title" aria-describedby="titleHelp">

                                    <div v-if="inputError.hasOwnProperty('title')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.title">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <label for="description">Description </label>
                                    <input ref="description"

                                           :class="{
                                                'is-valid':validateInputs.includes('description') && !validateInputCheck('description'),
                                                'is-invalid':validateInputs.includes('description') && validateInputCheck('description')
                                                }"

                                           type="text" v-model="input.description" name="description" class="form-control" id="description" aria-describedby="descriptionHelp">

                                    <div v-if="inputError.hasOwnProperty('description')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.description">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <label for="keywords">Keywords </label>
                                    <input ref="keywords"

                                           :class="{
                                                'is-valid':validateInputs.includes('keywords') && !validateInputCheck('keywords'),
                                                'is-invalid':validateInputs.includes('keywords') && validateInputCheck('keywords')
                                                }"

                                           type="text" v-model="input.keywords" name="keywords" class="form-control" id="keywords" aria-describedby="keywordsHelp">

                                    <div v-if="inputError.hasOwnProperty('keywords')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.keywords">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>


                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-3">
                                    <label for="logo"> Webiste Logo </label>
                                    <div class="row">
                                        <div class="col-8">
                                            <input
                                                :class="{
                                                'is-valid':validateInputs.includes('logo') && !validateInputCheck('logo'),
                                                'is-invalid':validateInputs.includes('logo') && validateInputCheck('logo')
                                                }"
                                                type="file"  v-on:change="fileInput($event,'logo')"name="logo" class="form-control-file" id="logo" aria-describedby="logoHelp">
                                        </div>
                                        <div class="col-4 inputLogo"> <small id="logoHelp" class="form-text text-muted text-center">Preview</small>
                                            <img  v-if="input.hasOwnProperty('logo')"  :src="input.logo" class="logoSample">
                                            <img  v-else :src="msData.img.logo" class="logoSample">


                                        </div>
                                    </div>

                                    <div v-if="inputError.hasOwnProperty('logo')" class="error-file">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.logo">
                                            {{er}}
                                        </div>


                                    </div>
                                </div>

                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-3">
                                    <label for="favico"> Webiste Favico </label>
                                    <div class="row">
                                        <div class="col-8">
                                            <input
                                                :class="{
                                                'is-valid':validateInputs.includes('favico') && !validateInputCheck('favico'),
                                                'is-invalid':validateInputs.includes('favico') && validateInputCheck('favico')
                                                }"
                                                type="file"  v-on:change="fileInput($event,'favico')"name="favico" class="form-control-file" id="favico" aria-describedby="favicoHelp">
                                        </div>
                                        <div class="col-4 inputLogo"> <small id="invoiceLogoHelp" class="form-text text-muted text-center">Preview</small>
                                            <img  v-if="input.hasOwnProperty('favico')"  :src="input.favico" class="logoSample">
                                            <img  v-else :src="msData.img.favico" class="logoSample">


                                        </div>
                                    </div>

                                    <div v-if="inputError.hasOwnProperty('favico')" class="error-file">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.favico">
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




                        <form @submit.prevent="processForm(msData.path['save.website'])">

                            <div class="row">

                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="name">Name </label>
                                    <input ref="name"

                                           :class="{
                                                'is-valid':validateInputs.includes('name') && !validateInputCheck('name'),
                                                'is-invalid':validateInputs.includes('name') && validateInputCheck('name')
                                                }"

                                           type="text" v-model="input.name" name="name" class="form-control" id="name">

                                    <div v-if="inputError.hasOwnProperty('name')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.name">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="sortname">Short Name </label>
                                    <input ref="sortname"

                                           :class="{
                                                'is-valid':validateInputs.includes('sortname') && !validateInputCheck('sortname'),
                                                'is-invalid':validateInputs.includes('sortname') && validateInputCheck('sortname')
                                                }"

                                           type="text" v-model="input.sortname" name="sortname" class="form-control" id="sortname">

                                    <div v-if="inputError.hasOwnProperty('sortname')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.sortname">
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

                                           type="number" v-model="input.unit" name="unit" class="form-control" id="unit">

                                    <div v-if="inputError.hasOwnProperty('unit')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.unit">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>
                                <div class="form-check col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="status">Visibilty </label>
                                <div class="form-control ">

                                    <label class="radio"><input  v-model="input.status" name="status" type="radio" value="1" ><span class="pl-2">Public</span></label>
                                    <label class="radio pl-2 "><input  v-model="input.status" name="status" type="radio" value="0"><span class="pl-2">Private</span></label>

                                </div>






                                    <div v-if="inputError.hasOwnProperty('status')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.status">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>

                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="dunitId">Down Unit </label>
                                    <select v-on:change="updateInput()" v-model="input.dunitId" class="form-control"  :class="{
                                                'is-valid':validateInputs.includes('dunitId') && !validateInputCheck('dunitId'),
                                                'is-invalid':validateInputs.includes('dunitId') && validateInputCheck('dunitId')
                                                }">
                                        <option  :value="0" selected>No Down Unit</option>
                                        <option v-for="unit in allUnits()" :value="unit.id">{{unit.name}}</option>

                                    </select>



                                    <div v-if="inputError.hasOwnProperty('dunitId')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.dunitId">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>

                                <div v-show="checkisValidSelect('dunitId','dunit')" class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="dunit">Down Unit Conversation</label>
                                    <input ref="dunit"

                                           :class="{
                                                'is-valid':validateInputs.includes('dunit') && !validateInputCheck('dunit'),
                                                'is-invalid':validateInputs.includes('dunit') && validateInputCheck('dunit')
                                                }"

                                           type="number" v-model="input.dunit" name="dunit" class="form-control" id="dunit">

                                    <div v-if="inputError.hasOwnProperty('dunit')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.dunit">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>



                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="uunitId">Up Unit </label>
                                    <select v-on:change="updateInput()" v-model="input.uunitId" class="form-control"  id="uunitId" :class="{
                                                'is-valid':validateInputs.includes('uunitId') && !validateInputCheck('uunitId'),
                                                'is-invalid':validateInputs.includes('uunitId') && validateInputCheck('uunitId')
                                                }">
                                        <option  :value="0" selected>No Down Unit</option>
                                        <option v-for="unit in allUnits()" :value="unit.id">{{unit.name}}</option>

                                    </select>



                                    <div v-if="inputError.hasOwnProperty('uunitId')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.uunitId">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>

                                <div  v-show="checkisValidSelect('uunitId','uunit')" class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="uunit">Up Unit Conversation </label>
                                    <input ref="uunit"

                                           :class="{
                                                'is-valid':validateInputs.includes('dunit') && !validateInputCheck('dunit'),
                                                'is-invalid':validateInputs.includes('dunit') && validateInputCheck('dunit')
                                                }"

                                           type="number" v-model="input.uunit" name="uunit" class="form-control" id="uunit">

                                    <div v-if="inputError.hasOwnProperty('uunit')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.uunit">
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
                                        </tr>

                                        <tr v-for="unit in allUnits()">
                                                <td>{{unit.name}}</td>
                                                <td>{{unit.shortname}}</td>
                                                <td>{{unit.unit}}</td>
                                                <td>{{unit.uunitName}}</td>
                                                <td>{{unit.uunit}}</td>
                                                <td>{{unit.dunitName}}</td>
                                                <td>{{unit.dunit}}</td>
                                        </tr>
                                    </table>

                                </div>


                            </div>



                        </form>





                    </div>
                    <div class="card-footer" v-if="false">
                        <div class="mt-3">

                            <input type="submit" class="btn btn-secondary col-12"  name="submit">

                        </div>
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
                validateInputs: ['CompanyName'],
                validationRules:{
                    'CompanyName':{ presence: {allowEmpty: false}}
                },
                currentFormTab:0,
                allUnitsFromServer:null,

            }
        },
        props: ['msData'],
        beforeMount() {

            if(this.msData.hasOwnProperty('inputData'))this.input=this.msData.inputData;
            this.updateInput();
            this.input.dunitId=0;
            this.input.uunitId=0;

        },
        methods: {
            checkisValidSelect(type,current){

                var check=this.input[type] == 0;
                if(check && this.input.hasOwnProperty(current)){
                    this.input[current]="";
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


            processForm(url) {
                var th = this;
                th.inputError = {};
                axios.post(url, this.input).then(function (res) {
                    var data = res.data;


                    Vue.toasted.success(data.msg,{duration:1000});

                    if(data.hasOwnProperty('nextUrl')){
                        window.VueApp.clickEventFromSideBar(data.nextUrl);
                    }
                }).catch(
                    function (e) {

                        th.inputError = e.response.data.errors;
                        Vue.toasted.error(e.response.data.message,{duration:1000});
                        th.updateError();
                    }
                );
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



                if(th.allUnitsFromServer==null ||  forced)axios.post(url).then(function (res) {

                    th.allUnitsFromServer=res.data.ResponseData;


                });

                return th.allUnitsFromServer;



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
