<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Website Settings</div>

                    <div class="card-body">




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
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

    export default {
        name: "website",
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
