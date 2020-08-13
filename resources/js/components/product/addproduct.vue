<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Add Proudct






                    </div>





                    <div v-show="currentFormTab== 0" class="card-body">




                        <form @submit.prevent="processForm((editCatDataPost)?msData.path['edit.cat']:msData.path['save.product'],input,'inputError')">

                            <div class="row">


                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="barcode">Barcode </label>
                                    <input ref="barcode"

                                           :class="{
                                                'is-valid':validateInputs.includes('barcode') && !validateInputCheck('barcode'),
                                                'is-invalid':validateInputs.includes('barcode') && validateInputCheck('barcode')
                                                }"

                                           type="text" v-model="input.barcode" name="barcode" class="form-control" id="barcode">

                                    <div v-if="inputError.hasOwnProperty('barcode')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.barcode">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>


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
                                    <label for="sname">Company </label>
                                    <input ref="sname"

                                           :class="{
                                                'is-valid':validateInputs.includes('sname') && !validateInputCheck('sname'),
                                                'is-invalid':validateInputs.includes('sname') && validateInputCheck('sname')
                                                }"

                                           type="text" v-model="input.sname" name="sname" class="form-control" id="sname">

                                    <div v-if="inputError.hasOwnProperty('sname')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.sname">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="version">Model/Version </label>
                                    <input ref="version"

                                           :class="{
                                                'is-valid':validateInputs.includes('version') && !validateInputCheck('version'),
                                                'is-invalid':validateInputs.includes('version') && validateInputCheck('version')
                                                }"

                                           type="text" v-model="input.version" name="version" class="form-control" id="version">

                                    <div v-if="inputError.hasOwnProperty('version')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.version">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>


                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="productLogo"> Product Image </label>
                                    <div class="row">
                                        <div class="col-8">
                                            <input
                                                :class="{
                                                'is-valid':validateInputs.includes('productLogo') && !validateInputCheck('productLogo'),
                                                'is-invalid':validateInputs.includes('productLogo') && validateInputCheck('productLogo')
                                                }"
                                                type="file"  v-on:change="fileInput($event,'productLogo')"name="productLogo" class="form-control-file" id="productLogo" aria-describedby="productLogoHelp">
                                            <span class="text-muted"> png, jpg, jpeg  allowed </span>
                                        </div>
                                        <div class="col-4 inputLogo"> <small id="productLogoHelp" class="form-text text-muted text-center">Preview</small>
                                            <img  v-if="input.hasOwnProperty('productLogo')"  :src="input.productLogo" class="logoSample border shadow-sm bg-white">
                                            <img  v-else :src="msData.img.productLogo" class="logoSample">


                                        </div>
                                    </div>

                                    <div v-if="inputError.hasOwnProperty('invoiceLogo')" class="error-file">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.invoiceLogo">
                                            {{er}}
                                        </div>


                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-9">
                                    <label for="pimgs"> Product Other Images </label>

                                    <div class="row">
                                        <div class="col-4">
                                            <input
                                                multiple
                                                :class="{
                                                'is-valid':validateInputs.includes('pimgs') && !validateInputCheck('pimgs'),
                                                'is-invalid':validateInputs.includes('pimgs') && validateInputCheck('pimgs')
                                                }"
                                                type="file"  v-on:change="fileInputs($event,'pimgs')"name="pimgs" class="form-control-file" id="pimgs" aria-describedby="pimgsHelp">

                                            <span class="text-muted"> Max 6 Image File  </span><br>
                                            <span class="text-muted"> png, jpg, jpeg  allowed </span>
                                        </div>
                                        <div class="col-8 inputLogo "> <small id="pimgsHelp" class="form-text text-muted text-center">Preview </small>

                                            <div class="row">

                                                <img  v-for="img in input.pimgs" v-if="input.hasOwnProperty('pimgs')"  :src="img" class="zoomOut-img mt-1 col-3 border shadow-sm bg-white">
                                                <div v-on:click="removeAllInputData('input','pimgs')"  v-if="input.hasOwnProperty('pimgs') && input.pimgs.length>0"  class="btn btn-sm btn-outline-danger col-12">X Remove All Images</div>
                                            </div>






                                        </div>
                                    </div>



                                    <div v-if="inputError.hasOwnProperty('invoiceLogo')" class="error-file">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.invoiceLogo">
                                            {{er}}
                                        </div>


                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-12">
                                    <label for="description">Description</label>


                                    <ckeditor :editor="editor" v-model="input.description" :config="editorConfig"></ckeditor>


                                    <div v-if="inputError.hasOwnProperty('description')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.description">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>

                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="cat">Category </label>
                                    <select v-on:change="allSubCategory(input.cat,true,true)" v-model="input.cat" name="cat" class="form-control"  id="cat" :class="{
                                                'is-valid':validateInputs.includes('cat') && !validateInputCheck('cat'),
                                                'is-invalid':validateInputs.includes('cat') && validateInputCheck('cat')
                                                }">

                                        <option v-for="unit in allCategory(false,'From Line 540')" :value="unit.id">{{unit.name}}</option>

                                    </select>



                                    <div v-if="inputError.hasOwnProperty('cat')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.cat">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>

                                <div  v-show="checkisValidSelect('cat','scat',input)" class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="scat">Sub Category </label>
                                    <select v-on:change="updateInput('scat')" v-model="input.scat" name="scat" class="form-control"  id="scat" :class="{
                                                'is-valid':validateInputs.includes('scat') && !validateInputCheck('scat'),
                                                'is-invalid':validateInputs.includes('scat') && validateInputCheck('scat')
                                                }">

                                        <option v-for="unit in allSubCategory(input.cat)" :value="unit.id">{{unit.name}}</option>

                                    </select>
                                    <div v-if="inputError.hasOwnProperty('scat')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.scat">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>


                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="unit">Unit</label>
                                    <select id="unit" v-on:change="updateInput()" v-model="input.unit" class="form-control"  :class="{
                                                'is-valid':validateInputs.includes('unit') && !validateInputCheck('unit'),
                                                'is-invalid':validateInputs.includes('unit') && validateInputCheck('unit')
                                                }">

                                        <option v-for="unit in allUnits()" :value="unit.id">{{unit.name}}</option>

                                    </select>



                                    <div v-if="inputError.hasOwnProperty('unit')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.unit">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>

                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="urate">Unit Rate </label>


                                    <div class="input-group">
                                        <input ref="urate"

                                               :class="{
                                                'is-valid':validateInputs.includes('urate') && !validateInputCheck('urate'),
                                                'is-invalid':validateInputs.includes('urate') && validateInputCheck('urate')
                                                }"

                                               type="number" v-model="input.urate" name="urate" class="form-control" id="urate">

                                        <div class="input-group-append" v-if="input.hasOwnProperty('unit')  && input.unit && allUnits().some(el => el.id === input.unit) ">
                                            <span class="input-group-text" id="basic-addon2"> <sub>/ {{ allUnits()[allUnits().findIndex(i => i.id === input.unit)]['shortname']}}</sub></span>
                                        </div>
                                    </div>





                                    <div v-if="inputError.hasOwnProperty('urate')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.urate">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>

                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="keepStock">Maintain Stock </label>
                                    <div class="form-control ">

                                        <label class="radio"><input  v-model="input.keepStock" id="keepStock" name="keepStock" type="radio" value="1" ><span class="pl-2">Yes </span></label>
                                        <label class="radio pl-2 "><input  v-model="input.keepStock" name="keepStock" type="radio" value="0"><span class="pl-2">No</span></label>

                                    </div>






                                    <div v-if="inputError.hasOwnProperty('keepStock')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.keepStock">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>

                                <div v-if="checkisValidSelect('keepStock','ostock',input)" class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="ostock">Open Stock</label>
                                    <input ref="ostock"

                                           :class="{
                                                'is-valid':validateInputs.includes('ostock') && !validateInputCheck('ostock'),
                                                'is-invalid':validateInputs.includes('ostock') && validateInputCheck('ostock')
                                                }"

                                           type="number" v-model="input.ostock" name="ostock" class="form-control" id="ostock">

                                    <div v-if="inputError.hasOwnProperty('ostock')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.ostock">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>

                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="feature">Feature Product</label>
                                    <div class="form-control ">

                                        <label class="radio"><input  v-model="input.feature" id="feature" name="feature" type="radio" value="1" ><span class="pl-2">Yes </span></label>
                                        <label class="radio pl-2 "><input  v-model="input.feature" name="feature" type="radio" value="0"><span class="pl-2">No</span></label>

                                    </div>






                                    <div v-if="inputError.hasOwnProperty('feature')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.feature">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label for="new">New Product Badge</label>
                                    <div class="form-control ">

                                        <label class="radio"><input  v-model="input.new" id="new" name="new" type="radio" value="1" ><span class="pl-2">Yes </span></label>
                                        <label class="radio pl-2 "><input  v-model="input.new" name="new" type="radio" value="0"><span class="pl-2">No</span></label>

                                    </div>






                                    <div v-if="inputError.hasOwnProperty('new')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.new">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>



                            </div>

                            <div class="row">
                                <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                    <hr>
                                        <h5 class="pl-1">
                                            Custom Fields
                                        </h5>
                                    <hr>

                                </div>

                                <div v-for="inpt in allExtraFields()" class=" col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <label :for="inpt.name">{{ inpt.dname  }} </label>
                                    <input :ref="inpt.name"

                                           :class="{
                                                'is-valid':validateInputs.includes(inpt.name) && !validateInputCheck(inpt.name),
                                                'is-invalid':validateInputs.includes('name') && validateInputCheck(inpt.name)
                                                }"

                                           type="text" v-model="input[inpt.name]" name="name" class="form-control" :id="inpt.name">

                                    <div v-if="inputError.hasOwnProperty(inpt.name)">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError[inpt.name]">
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

    import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
  //  import SimpleUploadAdapter from '@ckeditor/ckeditor5-upload/src/adapters/simpleuploadadapter';
    export default {

        name: "addproduct",
        props: ['msData'],
        components: {
            // Use the <ckeditor> component in this view.
            ckeditor: CKEditor.component
        },
        data(){
            return {

                editor: ClassicEditor,

                editorConfig: {
                    plugin:[],
                    toolbar: {
                        items: [
                            'heading',
                            '|',
                            'bold',
                            'italic',
                            '|',
                            'bulletedList',
                            'numberedList',
                            '|',
                            'insertTable',
                            '|',
                            'imageUpload',
                            '|',
                            'undo',
                            'redo'
                        ]
                    },
                    table: {
                        contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
                    },
                    language: 'en',
                    ckfinder: {
                        // The URL that the images are uploaded to.
                        uploadUrl: this.msData.path['upload.img'],

                    },

                },
                input: {},
                inputError: {},

                validateInputs: ['name','cat','scat'],
                validationRules:{
                    'name':{ presence: {allowEmpty: false}},
                    'cat':{ presence: {allowEmpty: false} ,isNotEqualTo:0},
                    'scat':{ presence: {allowEmpty: false} ,isNotEqualTo:0}
                },
                currentFormTab:0,
                allUnitsFromServer:null,
                editCatDataPost:false,
                allExtraFieldsFromServer:null,
                allCategoryFromServer:null,
                allSubCategoryFromServer:null,
                editFielsDataPost:false,
                getingCat:false,
                getingSubCat:false,
                getingExtra:false

            }


        },
        beforeMount() {
            this.allCategory();
            this.input.cat=0;
            this.input.scat=0;
            this.allExtraFields();

        },
        mounted(){
            this.updateInput();
        },
        methods:{

            allExtraFields(forced=false){
                var url=this.msData.path['get.allExtra']+"?cat="+this.input.cat+"&scat="+this.input.scat;
                var th=this;



                if((th.allExtraFieldsFromServer==null && !th.getingExtra && (this.input.hasOwnProperty('cat')&&this.input.hasOwnProperty('scat'))&&( this.input.cat!=0 &&this.input.scat!=0 )) ||  forced){

                    th.getingExtra=true;
                    axios.post(url).then(function (res) {

                        th.allExtraFieldsFromServer=res.data.ResponseData;


                    }).catch().then(function () {
                        th.getingExtra=false;
                    });
                }

                return th.allExtraFieldsFromServer;



            },

            checkisValidSelect(type,current,input=this.input){

                var check=input[type] == 0;
                if(check && input.hasOwnProperty(current)){
                    input[current]="";
                }

                return (check)? false:true;
            },
            allSubCategory(parentId,forced=false,fromChange=false){
                var url=this.msData.path['get.allSCat'];
                var th=this;

                var data={
                    id:parentId,
                };

                if(( !th.getingSubCat &&th.allSubCategoryFromServer==null && this.input.hasOwnProperty('cat') && (this.input.cat!=null||this.input.cat!=0 )) ||  forced){
                    th.getingSubCat=true;
                    axios.post(url,data).then(function (res) {

                        th.allSubCategoryFromServer =res.data.ResponseData;
                      if(fromChange){
                          if(th.input.hasOwnProperty('scat'))th.input.scat=0;
                          th.updateInput('cat');
                      }




                    }).catch(function (e) {
                        th.allSubCategoryFromServer=[];
                    }).then(function () {
                        th.getingSubCat=false;
                    });
                }


                return th.allSubCategoryFromServer;

            },
            removeAllInputData(input,inputName){
                //console.log(this.hasOwnProperty(input)&& this[input].hasOwnProperty(inputName));
                if(this.hasOwnProperty(input)&& this[input].hasOwnProperty(inputName)){
                    this[input][inputName]=[];
                    this.updateInput();

                }
                document.getElementById(inputName).value='';
            },
            fileInputs(e, inputName) {
                var limit=6
                const file = e.target.files;


               if(!this.input.hasOwnProperty(inputName))this.input[inputName]=[];

                if(file.length >limit || (this.input[inputName]!=null && this.input[inputName].length+file.length>limit)){
                    alert('Only '+limit+' image allowed to upload, and You selected more '+limit+' images');
                   if(file.length >limit){
                       e.target.value=''
                       //this.input[inputName]=[];
                   }
                    e.target.value=''
                    this.updateInput();
                }else{

                    var count =1;
                    for (var i in file){

                        var reader = new FileReader;
                        reader.onload = e => {
                            if(!this.input.hasOwnProperty(inputName))this.input[inputName]=[];

                            this.input[inputName].push(e.target.result)
                            this.updateInput();
                        }

                        count=count+1;
                        if(typeof file[i] =="object")reader.readAsDataURL(file[i])


                    }

                }





                // console.log(file[0])


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

                return this.allUnitsFromServer;
            },
            validateInputCheck(name, data = null) {
                var er = true;
                var customRule=false;
                var customData={};
                var customError=[];
                let defineData={...this.validationRules[name]};


                if(defineData.hasOwnProperty('isNotEqualTo')){
                    if(!customData.hasOwnProperty('isNotEqualTo')){
                        customData.isNotEqualTo=defineData.isNotEqualTo;
                        delete defineData.isNotEqualTo;
                    }
                }

               // console.log(defineData);


                var input = (data == null) ? this.input : data;
                var validatedData = window.validate.single(input[name],defineData);

                if(er && validatedData === undefined ){

                    for (var i in customData){
                        switch (i) {
                                case 'isNotEqualTo':
                                    if(customData.isNotEqualTo==input[name])customError.push(name+' should not be equal to '+customData.isNotEqualTo);
                                 //    console.log(input[name])
                                    break;
                        }
                    }
                }


                if (er && validatedData === undefined && customError.length<1) er = false;
                //   console.log(er);
                return er;
            },
            updateAllcategory(){
                this.input1={};
                this.inputError1={};
                this.allCategory(true);
            },
            restForm(){

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

            },
            updateInput(fromInput=null) {
                if(fromInput!=null){

                    switch (fromInput) {
                        case 'scat':
                            this.allExtraFields(true);
                            break;
                        case 'cat':
                            this.allExtraFields(true);
                            break;
                    }

                }
                var oldInput = this.input;
                this.input = null;
                this.input = oldInput;
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
        },
        watch:{
            allExtraFieldsFromServer(newVal,oldVal){
                for (var i in  oldVal){
                    if (this.input.hasOwnProperty(oldVal[i].name))delete this.input[oldVal[i].name];
                }
            }
        }
    }
</script>

<style scoped>

</style>
