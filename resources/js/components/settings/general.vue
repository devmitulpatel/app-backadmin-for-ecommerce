<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">General Settings</div>

                    <div class="card-body">




                        <form @submit.prevent="processForm(msData.path['save.general'])">

                            <div class="row">

                                <div class="form-group col-xs-12 col-sm-12 col-md-5 col-lg-6">
                                    <label for="companyName"> Company Name </label>
                                    <input ref="CompanyName"

                                           :class="{
                                                'is-valid':validateInputs.includes('CompanyName') && !validateInputCheck('CompanyName'),
                                                'is-invalid':validateInputs.includes('CompanyName') && validateInputCheck('CompanyName')
                                                }"

                                           type="text" v-model="input.CompanyName" name="companyName" class="form-control" id="companyName" aria-describedby="companyNameHelp">
                                    <small id="companyNameHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                    <div v-if="inputError.hasOwnProperty('CompanyName')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.CompanyName">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>

                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-3">
                                    <label for="websiteLogo"> Admin Panel Logo </label>

                                    <div class="row">
                                        <div class="col-8">

                                            <input

                                                :class="{
                                                'is-valid':validateInputs.includes('websiteLogo') && !validateInputCheck('websiteLogo'),
                                                'is-invalid':validateInputs.includes('websiteLogo') && validateInputCheck('websiteLogo')
                                                }"
                                                type="file" ref="websiteLogo"  v-on:change="fileInput($event,'websiteLogo')"  name="websiteLogo" class="form-control-file" id="websiteLogo" aria-describedby="websiteLogoHelp">
                                        </div>
                                        <div class="col-4 inputLogo"> <small id="websiteLogoHelp" class="form-text text-muted text-center">Preview</small>
                                            <img v-if="input.hasOwnProperty('websiteLogo')" :src="input.websiteLogo"   class="logoSample">
                                            <img v-else :src="msData.img.WebsiteLogo" class="logoSample">
                                        </div>


                                    </div>
                                    <div v-if="inputError.hasOwnProperty('websiteLogo')" class="error-file">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.websiteLogo">
                                            {{er}}
                                        </div>


                                    </div>


                                </div>

                                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-3">
                                    <label for="invoiceLogo"> Invoice Logo </label>
                                    <div class="row">
                                        <div class="col-8">
                                            <input
                                                :class="{
                                                'is-valid':validateInputs.includes('invoiceLogo') && !validateInputCheck('invoiceLogo'),
                                                'is-invalid':validateInputs.includes('invoiceLogo') && validateInputCheck('invoiceLogo')
                                                }"
                                                type="file"  v-on:change="fileInput($event,'invoiceLogo')"name="invoiceLogo" class="form-control-file" id="invoiceLogo" aria-describedby="invoiceLogoHelp">
                                        </div>
                                        <div class="col-4 inputLogo"> <small id="invoiceLogoHelp" class="form-text text-muted text-center">Preview</small>
                                            <img  v-if="input.hasOwnProperty('invoiceLogo')"  :src="input.invoiceLogo" class="logoSample">
                                            <img  v-else :src="msData.img.InvoiceLogo" class="logoSample">


                                        </div>
                                    </div>

                                    <div v-if="inputError.hasOwnProperty('invoiceLogo')" class="error-file">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.invoiceLogo">
                                            {{er}}
                                        </div>


                                    </div>
                                </div>





                            </div>

                            <div class="row">


                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="invoiceLogo">  Privacy Policy </label>
                                    <div class="row">
                                        <div class="col-12">
                                           <ckeditor :editor="editor" v-model="input.PrivatePolicy" :config="editorConfig"></ckeditor>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="invoiceLogo">About us</label>
                                    <div class="row">
                                        <div class="col-12">
                                           <ckeditor :editor="editor" v-model="input.AboutUs" :config="editorConfig"></ckeditor>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="invoiceLogo">Contact Us</label>
                                    <div class="row">
                                        <div class="col-12">
                                           <ckeditor :editor="editor" v-model="input.ContcatUs" :config="editorConfig"></ckeditor>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="invoiceLogo">Term & Conditions</label>
                                    <div class="row">
                                        <div class="col-12">
                                           <ckeditor :editor="editor" v-model="input.TermNCondition" :config="editorConfig"></ckeditor>
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

    export default {
        name: "general",
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
                }
            }
        },
        props: ['msData'],
        beforeMount() {

            if(this.msData.hasOwnProperty('inputData'))this.input=this.msData.inputData;
            this.updateInput();

        },
        methods: {
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
