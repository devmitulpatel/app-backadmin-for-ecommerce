<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Mange Categories






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


                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

    export default {
        name: "category",
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
                editUnitDataPost:false,
                allExtraFieldsFromServer:null,
                allCategoryFromServer:null,
                allSubCategoryFromServer:null,
                editFielsDataPost:false
            }


        },
        methods:{
            allUnits(){
                return this.allUnitsFromServer;
            }
        }
    }
</script>

<style scoped>

</style>
