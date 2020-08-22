<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Manage Video App





                        <ul class="nav nav-tabs piflex-column flex-sm-row formtab-fixed" >

                            <li v-for="(t,k) in  tabs" class="nav-item " v-on:click="changeTab(k)"   >
                                <a class="nav-link " :class="{
                                    'active':currentFormTab== k,
                                    'ml-1':k>0
                                }" >{{t.name}}</a>
                            </li>

                        </ul>



                    </div>
                    <div v-for="(t,k) in tabs" v-show="currentFormTab== k" class="card-body">

                        <form @submit.prevent="processForm(t.path)" v-if="t.hasOwnProperty('inputs')" >


                            <div class="row">

                                <div class="form-group "
                                     v-for="input in t.inputs"
                                     :class='{
                                "col-xs-12 col-sm-12 col-md-3 col-lg-3":!input.hasOwnProperty("size"),
                                [input.size]:input.hasOwnProperty("size")
                                }'

                                >


                                    <div v-if="input.type=='text'|| input.type=='file'||input.type=='number'">


                                        <label :for="makeModelName(t.model,input.model)">{{input.name}} {{[t.model.toString()]['name']}} </label>





                                        <input v-if="input.type=='file'" :ref="makeModelName(t.model,input.model)"

                                               :class="{
                                                'is-valid':validateInputs.includes(makeModelName(t.model)[input.model]) && !validateInputCheck(makeModelName(t.model)[input.model]),
                                                'is-invalid':validateInputs.includes(makeModelName(t.model)[input.model]) && validateInputCheck(makeModelName(t.model)[input.model])
                                                }"

                                               :type="input.type" v-on:change="updateInput($event,$data,input.type,t.model,input.model)"   :name="makeModelName(t.model,input.model)" class="form-control" :id="makeModelName(t.model,input.model)">

                                        <input v-if="input.type=='text'||input.type=='number'" :ref="makeModelName(t.model,input.model)"

                                               :class="{
                                                'is-valid':validateInputs.includes(makeModelName(t.model)[input.model]) && !validateInputCheck(makeModelName(t.model)[input.model]),
                                                'is-invalid':validateInputs.includes(makeModelName(t.model)[input.model]) && validateInputCheck(makeModelName(t.model)[input.model])
                                                }"

                                               :type="input.type" v-on:change="updateInput($event,input.type,t.model,input.model)" v-model="$data[makeModelName(t.model)][input.model]"  :name="makeModelName(t.model,input.model)" class="form-control" :id="makeModelName(t.model,input.model)">



                                        <div  v-if="$data[makeModelName(t.model)].hasOwnProperty(input.model)" >

                                            <img :src="$data[makeModelName(t.model)][input.model]">
                                            <small>Preview</small>
                                        </div>


                                    </div>



                                    {{[t.model][input.model]}}

                                    <div v-if="inputError1.hasOwnProperty(input.model)">

                                        <div class="alert alert-danger" role="alert" v-for="er in inputError1[input.model]">
                                            {{er}}
                                        </div>


                                    </div>




                                </div>


                            </div>



                            <div class="mt-3">

                                <input type="submit" class="btn btn-secondary col-12"  name="submit">

                            </div>

                        </form>

                        <div v-if="t.hasOwnProperty('list') && t.list.hasOwnProperty('columns')">

                            <table class="table table-bordered">
                                <tr>
                                    <th v-for="c in t.list.columns">{{c}}</th>
                                </tr>

                                <tr v-for="r in list_frame">

                                </tr>

                            </table>

                        </div>
                    </div>





                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "allForms",
        props: ['msData'],
        data(){
            return{
                currentFormTab:0,
                input_frame:{},
                input_image:{},
                input_sticker:{},
                input_ringtone:{},
                input_ringtoneCat:{},

                list_frame:[],
                list_image:[],
                list_sticker:[],
                list_ringtone:[],
                list_ringtoneCat:[],
                tabs:[

                    {
                        name:'Frame',
                        model:'frame',
                        path:'/test',
                        inputs:[

                            {
                                name:'Name',
                                model:'name',
                                type:'text',

                            } ,
                            {
                                name:'Image',
                                model:'imageUrl',
                                type:'file',

                            },
                            {
                                name:'Thumb Images',
                                model:'thumnUrk',
                                type:'file',

                            },
                            {
                                name:'Status',
                                model:'status',
                                type:'radio',

                            }

                        ],
                        list:{
                            model:'list_frame',
                            columns:['name', 'Image','Thumb Image'],
                            path:this.msData.path.retriveListData

                        }
                    },

                    {
                        name:'Image',
                        model:'image',
                        path:'/test',
                        inputs:[

                            {
                                name:'Image',
                                model:'imageUrl',
                                type:'file',

                            },

                            {
                                name:'Status',
                                model:'status',
                                type:'radio',

                            }

                        ],
                        list:{
                            model:'list_image',
                            columns:['name'],
                            path:this.msData.path.retriveListData
                        }
                    },

                    {
                        name:'Sticker',
                        model:'sticker',
                        path:'/test',
                        inputs:[
                            {
                                name:'Name',
                                model:'name',
                                type:'text',

                            } ,

                            {
                                name:'Image',
                                model:'imageUrl',
                                type:'file',

                            },

                            {
                                name:'Status',
                                model:'status',
                                type:'radio',

                            }

                        ]
                    },

                    {
                        name:'Ringtone',
                        model:'ringtone',
                        path:'/test',
                        inputs:[

                            {
                                name:'Name',
                                model:'name',
                                type:'text',

                            } ,
                            {
                                name:'Music File',
                                model:'mp3Url',
                                type:'file',

                            },
                            {
                                name:'Thumb Images',
                                model:'thumbUrl',
                                type:'file',

                            },
                            {
                                name:'Status',
                                model:'status',
                                type:'radio',

                            }

                        ]
                    },

                    {
                        name:'Ringtone Category',
                        model:'ringtoneCat',
                        path:'/test',
                        inputs:[

                            {
                                name:'Name',
                                model:'name',
                                type:'text',

                            } ,
                            {
                                name:'Thumb Images',
                                model:'icon',
                                type:'file',

                            },
                            {
                                name:'Status',
                                model:'status',
                                type:'radio',

                            }

                        ]
                    }


                ],

                allFiles:{},
                validateInputs:[],
                inputError1:[],
                allInputs:{},
                getttingData:false


            }

        },
        created(){

            for (var i in this.tabs){
             //   this.allInputs[this.makeModelName(this.tabs[i].model)]={};
                if(this.tabs[i].hasOwnProperty('inputs'))for (var y in this.tabs[i]['inputs']){
                //    console.log( this.tabs[i]['inputs'][y].model);
               //     this.allInputs[this.makeModelName(this.tabs[i].model)][this.tabs[i]['inputs'][y].model]=null;
                 //   console.log( this.allInputs);
                }

                this.getDataFor(this.tabs[i].model)
            }



        },
        methods:{


            getDataFor(type){
                var data={
                    type:type
                };

                var url=this.msData.path.retriveListData;
                var dataModel=['list',type].join('_');
                var th=this;

                    axios.post(url,data).then(function(res){


                        var inData=res.data.ResponseMessage;

                        th[dataModel]=inData;
                     //   th.getttingData=false;

                    }).catch(function(e){

                       // th.getttingData=false;

                    });




            },


            retriveData(model,list,force=false){
                var data= {
                  type:model
                };

                var dataModel=list.model;

                var url=list.path;
                var th=this;
                if(th.getttingData!=true){
                    th.getttingData=true;
                    axios.post(url,data).then(function(res){

                    console.log(res);
                    var inData=res.data.ResponseMessage;

                    th[dataModel]=inData;
                    th.getttingData=false;

                }).catch(function(e){

                        th.getttingData=false;

                });
                }

            return  this[dataModel];
            },
            refreshInput(name){
                var old=this[name];
                this[name]={};
                this[name]=old;
            },
            changeTab(tab){
                if(this.currentFormTab!=tab)this.currentFormTab=tab;
            },
            validateInputCheck(){
                true;
            },
            makeModelName(name='',subname=false){
                return (subname==false)?['input',name].join('_'):['input',name,subname].join('_');
            },

            updateInput(e,d, type,rootmodel,submodel) {

                switch (type) {
                    case 'file':
                        this.handleFileInputUpdate(e,d, rootmodel,submodel);
                        break;
                }



            },
            handleFileInputUpdate(e,d,rootmodel,submodel){




                const file = e.target.files;
                var rootModelFinal=this.makeModelName(rootmodel);


                if(!this.allFiles.hasOwnProperty(rootModelFinal))this.allFiles[rootModelFinal]={};

                this.allFiles[rootModelFinal][submodel]=file[0];

                if(!(rootmodel=='ringtone' && submodel=='mp3Url')){

                    var th=this;
                    let reader = new FileReader;
                    reader.onload = e => {
                        if(!d.hasOwnProperty(rootModelFinal))d[rootModelFinal]={};
                        d[rootModelFinal][submodel] = e.target.result;
                        th.refreshInput(rootModelFinal);
                        // this.updateInput();
                    }
                    reader.readAsDataURL(file[0]);

                }


            }
        },
    }
</script>

<style scoped>

    [type=file]{
        padding:3px;
    }
    img{
        max-width:100px;
        max-height:100px;
    }
    table{
        margin-top:20px;
    }

</style>
