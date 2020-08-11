<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Add Proudct






                    </div>





                    <div v-show="currentFormTab== 0" class="card-body">




                        <form @submit.prevent="processForm((editCatDataPost)?msData.path['edit.cat']:msData.path['save.cat'],input,'inputError1','updateAllcategory')">

                            <div class="row">

                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
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
                                <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-5">
                                    <label for="productLogoOther"> Product Other Images </label>

                                    <div class="row">
                                        <div class="col-4">
                                            <input
                                                multiple
                                                :class="{
                                                'is-valid':validateInputs.includes('productLogoOther') && !validateInputCheck('productLogoOther'),
                                                'is-invalid':validateInputs.includes('productLogoOther') && validateInputCheck('productLogoOther')
                                                }"
                                                type="file"  v-on:change="fileInputs($event,'productLogoOther')"name="productLogoOther" class="form-control-file" id="productLogoOther" aria-describedby="productLogoOtherHelp">

                                            <span class="text-muted"> Max 6 Image File  </span><br>
                                            <span class="text-muted"> png, jpg, jpeg  allowed </span>
                                        </div>
                                        <div class="col-8 inputLogo "> <small id="productLogoOtherHelp" class="form-text text-muted text-center">Preview </small>

                                            <div class="row">

                                                <img  v-for="img in input.productLogoOther" v-if="input.hasOwnProperty('productLogoOther')"  :src="img" class="zoomOut-img mt-1 col-3 border shadow-sm bg-white">
                                                <div v-on:click="removeAllInputData('input','productLogoOther')"  v-if="input.hasOwnProperty('productLogoOther') && input.productLogoOther.length>0"  class="btn btn-sm btn-outline-danger col-12">X Remove All Images</div>
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
        }
    }
</script>

<style scoped>

</style>
