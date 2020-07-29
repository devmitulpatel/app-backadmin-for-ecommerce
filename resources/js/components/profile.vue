<template>


    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">User Profile</div>

                    <div class="card-body">




                        <form @submit.prevent="processForm(msData.path['save.profile'])">

                            <div class="row">

                                <div class="form-group col-xs-12 col-sm-12 col-md-5 col-lg-6">
                                    <label for="name"> Name </label>
                                    <input

                                           :class="{
                                                'is-valid':validateInputs.includes('name') && !validateInputCheck('name'),
                                                'is-invalid':validateInputs.includes('name') && validateInputCheck('name')
                                                }"

                                           type="text" v-model="input.name" name="companyName" class="form-control" id="name" aria-describedby="nameHelp">
<!--                                    <small id="nameHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                                    <div v-if="inputError.hasOwnProperty('name')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.name">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>

                                <div class="form-group col-xs-12 col-sm-12 col-md-5 col-lg-6">
                                    <label for="name"> Email </label>
                                    <input

                                           :class="{
                                                'is-valid':validateInputs.includes('email') && !validateInputCheck('email'),
                                                'is-invalid':validateInputs.includes('email') && validateInputCheck('email')
                                                }"

                                           type="text" v-model="input.email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
<!--                                    <small id="nameHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                                    <div v-if="inputError.hasOwnProperty('email')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.email">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>

                            </div>

                            <div class="row">

                                <div class="form-group col-xs-12 col-sm-12 col-md-5 col-lg-6">
                                    <label for="password"> Password </label>
                                    <input

                                           :class="{
                                                'is-valid':validateInputs.includes('password') && !validateInputCheck('password'),
                                                'is-invalid':validateInputs.includes('password') && validateInputCheck('password')
                                                }"

                                           type="text" v-model="input.password" name="password" class="form-control" id="password" aria-describedby="passwordHelp">
<!--                                    <small id="nameHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                                    <div v-if="inputError.hasOwnProperty('password')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.password">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>

                                <div class="form-group col-xs-12 col-sm-12 col-md-5 col-lg-6">
                                    <label for="password_confirmation"> Confirm Password </label>
                                    <input

                                           :class="{
                                                'is-valid':validateInputs.includes('password_confirmation') && !validateInputCheck('password_confirmation'),
                                                'is-invalid':validateInputs.includes('password_confirmation') && validateInputCheck('password_confirmation')
                                                }"

                                           type="text" v-model="input.password_confirmation" name="password_confirmation" class="form-control" id="password_confirmation" aria-describedby="confirmPasswordHelp">
<!--                                    <small id="nameHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                                    <div v-if="inputError.hasOwnProperty('password_confirmation')">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError.password_confirmation">
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
        name: "profile",
        data() {
            return {
                editor: ClassicEditor,
                editorConfig: {
                    // The configuration of the editor.
                },
                input: {},
                inputError: {},
                validateInputs: ['name','email','password'],
                validationRules:{
                    'name':{ presence: {allowEmpty: false}},
                    'email':{email:true, presence: {allowEmpty: false}},
                    'password':{ presence: {allowEmpty: true}},

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
