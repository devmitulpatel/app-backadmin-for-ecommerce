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

                        <form @submit.prevent="processForm($event,(!editOn)?t.path:t.editpath,k)" v-if="t.hasOwnProperty('inputs')" >


                            <div class="row">

                                <div class="form-group "
                                     v-for="input in t.inputs"
                                     :class='{
                                "col-xs-12 col-sm-12 col-md-3 col-lg-3":!input.hasOwnProperty("size"),
                                [input.size]:input.hasOwnProperty("size")
                                }'

                                >


                                    <div v-if="input.type=='text'|| input.type=='file'||input.type=='number'||input.type=='option'">


                                        <label :for="makeModelName(t.model,input.model)">{{input.name}} {{[t.model.toString()]['name']}} </label>





                                        <input :required="!editOn" v-if="input.type=='file'" :ref="makeModelName(t.model,input.model)"

                                               :class="{
                                                'is-valid':validateInputs.includes(makeModelName(t.model)[input.model]) && !validateInputCheck(makeModelName(t.model)[input.model]),
                                                'is-invalid':validateInputs.includes(makeModelName(t.model)[input.model]) && validateInputCheck(makeModelName(t.model)[input.model])
                                                }"

                                               :type="input.type" v-on:change="updateInput($event,$data,input.type,t.model,input.model)"   :name="makeModelName(t.model,input.model)" class="form-control" :id="makeModelName(t.model,input.model)">

                                        <input :required="!editOn" v-if="input.type=='text'||input.type=='number'" :ref="makeModelName(t.model,input.model)"

                                               :class="{
                                                'is-valid':validateInputs.includes(makeModelName(t.model)[input.model]) && !validateInputCheck(makeModelName(t.model)[input.model]),
                                                'is-invalid':validateInputs.includes(makeModelName(t.model)[input.model]) && validateInputCheck(makeModelName(t.model)[input.model])
                                                }"

                                               :type="input.type" v-on:change="updateInput($event,input.type,t.model,input.model)" v-model="$data[makeModelName(t.model)][input.model]"  :name="makeModelName(t.model,input.model)" class="form-control" :id="makeModelName(t.model,input.model)">

                                        <div v-if="input.type=='option'">

                                            <select  :class="{
                                                'is-valid':validateInputs.includes(makeModelName(t.model)[input.model]) && !validateInputCheck(makeModelName(t.model)[input.model]),
                                                'is-invalid':validateInputs.includes(makeModelName(t.model)[input.model]) && validateInputCheck(makeModelName(t.model)[input.model])
                                                }"

                                                     :type="input.type" v-on:change="updateInput($event,input.type,t.model,input.model)" v-model="$data[makeModelName(t.model)][input.model]"  :name="makeModelName(t.model,input.model)" class="form-control" :id="makeModelName(t.model,input.model)">
                                                <option v-for="v in $data[input.data]" :value="v.id">{{v.name}}</option>



                                            </select>


                                        </div>



                                        <div  v-if="input.type=='file' && $data[makeModelName(t.model)].hasOwnProperty(input.model)" >

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
                                    <th v-for="c in t.list.columns">{{c.text}}</th>
                                    <th style="text-align:center;">Action</th>
                                </tr>

                                <tr v-for="(r,k) in  $data[t.list.model]">

                                    <td v-for="c in t.list.columns">

                                        <div v-if="c.type=='text'">
                                        {{r[c.model]}}
                                        </div>

                                        <div v-if="c.type=='image'">
                                            <img :src="r[c.model]" style="max-height: 100px;">
                                        </div>
                                        <div v-if="c.type=='music'">


                                            <audio controls>
                                                <source :src="r[c.model]" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>

                                        </div>

                                        <div v-if="c.type=='option'">

                                                  {{getDynamicFromId(r[c.model],c.data)}}

                                        </div>

                                    </td>
                                    <td>
                                        <div class="btn-group col-12" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-outline-info" v-on:click="editRow(t.model,r)"><i class="fas fa-pencil-alt"></i></button>
                                            <button type="button" class="btn btn-outline-danger" v-on:click="deleteRow(t.model,r)"><i class="fas fa-trash-alt"></i></button>

                                        </div>

                                    </td>

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
                        path:this.msData.path.feedDatatoDB,
                        editpath:this.msData.path.edit,
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
                                model:'thumbUrl',
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
                            columns:[
                                {
                                    'text':'Name',
                                    'model':'name',
                                    'type':'text',

                                },
                                {
                                    'text':'Image',
                                    'model':'imageUrl',
                                    'type':'image',

                                },
                                {
                                    'text':'Thumbnail',
                                    'model':'thumbUrl',
                                    'type':'image',

                                }

                            ],
                            path:this.msData.path.retriveListData



                        }
                    },

                    {
                        name:'Image',
                        model:'image',
                        path:this.msData.path.feedDatatoDB,
                        editpath:this.msData.path.edit,
                        inputs:[

                            {
                                name:'Image',
                                model:'thumbUrl',
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
                            columns:[

                                {
                                    'text':'Image',
                                    'model':'thumbUrl',
                                    'type':'image',

                                },


                            ],
                            path:this.msData.path.retriveListData

                        }
                    },

                    {
                        name:'Sticker',
                        model:'sticker',
                        path:this.msData.path.feedDatatoDB,
                        editpath:this.msData.path.edit,
                        inputs:[
                            {
                                name:'Name',
                                model:'name',
                                type:'text',

                            } ,

                            {
                                name:'Image',
                                model:'thumbUrl',
                                type:'file',

                            },



                        ],
                        list:{
                            model:'list_sticker',
                            columns:[

                                {
                                    text:'Name',
                                    model:'name',
                                    type:'text',

                                },
                                {
                                    text:'Thumb Image',
                                    model:'thumbUrl',
                                    type:'image',

                                }


                            ],
                            path:this.msData.path.retriveListData

                        }
                    },

                    {
                        name:'Ringtone',
                        model:'ringtone',
                        path:this.msData.path.feedDatatoDB,
                        editpath:this.msData.path.edit,
                        inputs:[

                            {
                                name:'Name',
                                model:'name',
                                type:'text',

                            } ,
                            {
                                name:'Type',
                                model:'type',
                                type:'option',
                                data:'list_ringtoneCat',

                            } ,

                            {
                                name:'Music File',
                                model:'mp3Url',
                                type:'file',

                            },
                            {
                                name:'Thumb Image',
                                model:'thumbUrl',
                                type:'file',

                            }

                        ],
                        list:{
                            model:'list_ringtone',
                            columns:[

                                {
                                    text:'Name',
                                    model:'name',
                                    type:'text',

                                },
                                {
                                    text:'Music file',
                                    model:'mp3Url',
                                    type:'music',

                                },
                                {
                                    text:'Thumb Image',
                                    model:'thumbUrl',
                                    type:'image',

                                },
                                {
                                    text:'Type',
                                    model:'type',
                                    type:'option',
                                    data:'list_ringtoneCat'

                                }


                            ],
                            path:this.msData.path.retriveListData

                        }
                    },

                    {
                        name:'Ringtone Category',
                        model:'ringtoneCat',
                        path:this.msData.path.feedDatatoDB,
                        editpath:this.msData.path.edit,
                        inputs:[

                            {
                                name:'Name',
                                model:'name',
                                type:'text',

                            } ,
                            {
                                name:'Thumb Image',
                                model:'icon',
                                type:'file',

                            }

                        ],
                        list:{
                            model:'list_ringtoneCat',
                            columns:[

                                {
                                    text:'Name',
                                    model:'name',
                                    type:'text',

                                },
                                {
                                    text:'Icon Image',
                                    model:'icon',
                                    type:'image',

                                }


                            ],
                            path:this.msData.path.retriveListData

                        }
                    }


                ],

                editOn:false,

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
            getDynamicFromId(id,data){

                id=id.toString();
                var mData=this[data];
                var foundKey=false;
                for (var i in mData){
                    console.log("--Start---");
                    console.log(mData[i] );
                    if(mData[i].id==id)foundKey=i;
                    if(foundKey==false){
                        console.log(id);
                        console.log(mData[i].id);
                        console.log(mData[i].id==id);
                        console.log("---End--");
                    }
                }

                return (foundKey===false)?"No Ringtone Category Found":mData[foundKey].name;

            },
            editRow(model,d){

                var n= this.makeModelName(model);
                this[n]=d;
                this.editOn=true;

            },

            deleteRow(model,d){

                var data={
                    id:d.id,
                    type:model
                };
                var url =this.msData.path.delete;
                var th = this;
                axios.post(url,data).then(function (res) {

                    var data=res.data;
                    if(data.hasOwnProperty('ResponseMessage') && typeof data.ResponseMessage == "object")Vue.toasted.success(data.ResponseMessage[0],{duration:1000});
                    th.getDataFor(model);
                  //  th.resetForm(baseData.model);

                }).catch(function (e) {
                    var data=e.response;
                    if(data.hasOwnProperty('ResponseMessage') && typeof data.ResponseMessage == "object")Vue.toasted.error(data.ResponseMessage[0],{duration:1000});
                });

              console.log(d.id);
            },

            processForm(e,url,formType){
            //console.log(e);
                switch(formType){
                    case 0:
                        var inputData=this.input_frame;
                        var baseData=this.tabs[formType];

                        var files=(this.allFiles.hasOwnProperty(['input',this.tabs[formType].model].join('_')))?this.allFiles[['input',this.tabs[formType].model].join('_')]:{};

                        var fData= new FormData();

                        for(var i in inputData){
                            if(files.hasOwnProperty(i)){
                            fData.append(i,files[i],files[i].name);
                            }else{
                                fData.append(i,inputData[i]);
                            }
                        }

                        fData.append('formtype',formType);

                        break;

                    case 1:
                        var inputData=this.input_image;
                        var baseData=this.tabs[formType];

                        var files=(this.allFiles.hasOwnProperty(['input',this.tabs[formType].model].join('_')))?this.allFiles[['input',this.tabs[formType].model].join('_')]:{};

                        var fData= new FormData();

                        for(var i in inputData){
                            if(files.hasOwnProperty(i)){
                                fData.append(i,files[i],files[i].name);
                            }else{
                                fData.append(i,inputData[i]);
                            }
                        }

                        fData.append('formtype',formType);
                        break;
                    case 2:
                        var inputData=this.input_sticker;
                        var baseData=this.tabs[formType];

                        var files=(this.allFiles.hasOwnProperty(['input',this.tabs[formType].model].join('_')))?this.allFiles[['input',this.tabs[formType].model].join('_')]:{};

                        var fData= new FormData();

                        for(var i in inputData){
                            if(files.hasOwnProperty(i)){
                                fData.append(i,files[i],files[i].name);
                            }else{
                                fData.append(i,inputData[i]);
                            }
                        }

                        fData.append('formtype',formType);
                        break;
                    case 3:
                        var inputData=this.input_ringtone;
                        var baseData=this.tabs[formType];

                        var files=(this.allFiles.hasOwnProperty(['input',this.tabs[formType].model].join('_')))?this.allFiles[['input',this.tabs[formType].model].join('_')]:{};

                        var fData= new FormData();

                        for(var i in inputData){
                            if(files.hasOwnProperty(i)){
                                fData.append(i,files[i],files[i].name);
                            }else{
                                fData.append(i,inputData[i]);
                            }
                        }

                        fData.append('formtype',formType);
                        break;

                    case 4:
                        var inputData=this.input_ringtoneCat;
                        var baseData=this.tabs[formType];

                        var files=(this.allFiles.hasOwnProperty(['input',this.tabs[formType].model].join('_')))?this.allFiles[['input',this.tabs[formType].model].join('_')]:{};

                        var fData= new FormData();

                        for(var i in inputData){
                            if(files.hasOwnProperty(i)){
                                fData.append(i,files[i],files[i].name);
                            }else{
                                fData.append(i,inputData[i]);
                            }
                        }

                        fData.append('formtype',formType);
                        break;

                }

                var th =this;
                axios.post(url,fData).then(function (res) {

                    var data=res.data;
                    if(data.hasOwnProperty('ResponseMessage') && typeof data.ResponseMessage == "object")Vue.toasted.success(data.ResponseMessage[0],{duration:1000});
                    th.getDataFor(baseData.model);
                    th.resetForm(baseData.model);

                }).catch(function (e) {
                    var data=e.response;
                    if(data.hasOwnProperty('ResponseMessage') && typeof data.ResponseMessage == "object")Vue.toasted.error(data.ResponseMessage[0],{duration:1000});
                });


            },

            resetForm(model){
                if(this.editOn)this.editOn=false;
                var n=this.makeModelName(model);
                this.allFiles[n]={};
                this[n]={};

            },

            validateDataForm(inputData,baseData){

                    var inputs=baseData.inputs;

                    for (var i in inputs){
                        if(inputs[i].hasOwnProperty('model') && inputData.hasOwnProperty(inputs[i].model) && inputData[inputs[i].model].hasOwnProperty('validate')){






                        }
                    }


            },

            getDataFor(type){
                var data={
                    type:type
                };
                //Vue.toasted.success('Waiting For New Data',{duration:500});
                var url=this.msData.path.retriveListData;
                var dataModel=['list',type].join('_');
                var th=this;

                    axios.post(url,data).then(function(res){


                        var inData=res.data.ResponseMessage;

                        th[dataModel]=inData;
                      //  Vue.toasted.success('New Data Loaded',{duration:500});
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
                var th=this;
                if(!(rootmodel=='ringtone' && submodel=='mp3Url')){


                    let reader = new FileReader;
                    reader.onload = e => {
                        if(!d.hasOwnProperty(rootModelFinal))d[rootModelFinal]={};
                        d[rootModelFinal][submodel] = e.target.result;
                        th.refreshInput(rootModelFinal);
                        // this.updateInput();
                    }
                    reader.readAsDataURL(file[0]);

                }else{
                    d[rootModelFinal][submodel] ='musicfile';
                    th.refreshInput(rootModelFinal);
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
