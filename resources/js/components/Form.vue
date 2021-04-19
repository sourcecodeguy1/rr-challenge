<template>
    <div class="row" style="margin-top: 150px;">

        <div class="col-sm-3"></div>

        <div class="col-sm-6">

            <header-title></header-title>

            <div class="p-5 m-3 w-78 shadow">

                <div class="row">

                    <div class="col-sm-9">
                        <img :src="'../images/rr-logo.svg'" alt="RR Logo">
                    </div>

                    <div class="col-sm-3">
                        <img class="image-size" :src="'../images/help-icon.png'" alt="RR Logo">
                    </div>

                    <div style="color: #ea5d24;"><strong>Work Remotely. Better</strong></div>

                    <br />
                    <br />

                    <div>

                        <div >
                            <div id="message_result" class="alert alert-danger alert-dismissible fade" role="alert">

                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                            </div>
                        </div>

                        <form @submit.prevent="handleSubmit">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">Name<span style="color: #ea5d24;">*</span></label>
                                <input v-model="first_name" @keyup='fNameCharCount()' minlength="2" maxlength="50" type="text" class="form-control" name="first_name" id="first_name">
                                <div style="float: right; color: gray;">{{ totalFNameCharacter + '/' + maxCharacterFName }}</div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail Address<span style="color: #ea5d24;">*</span></label>
                                <input v-model="email" type="email" class="form-control" name="email" id="email">
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Questions / Comments<span style="color: #ea5d24;">*</span></label>
                                <textarea type="number" v-model='message' @keyup='charCount()' minlength="6" maxlength="200" class="form-control" name="message" id="message" rows="3"></textarea>
                                <div style="float: right; color: gray;">{{ totalcharacter + '/' + maxCharacter }}</div>
                            </div >
                            <br />
                            <div>
                                <button type="submit" class="btn btn-default" style="background-color: #ea5d24; color: white; width: 125px;">Submit</button>
                                <button type="button" @click="resetFormValues" class="text-center" style="background-color: white; color: gray; float: right; margin-top: 5px;">Reset</button>
                                <div></div>
                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>



</template>

<script>
import axios from 'axios';

import HeaderTitle from "./HeaderTitle";

export default {
    name: "Form",
    data() {
       return  {
           first_name: "",
           email: "",
           message: "",
           totalcharacter: 0,
           minCharacter: 6,
           maxCharacter: "200",
           totalFNameCharacter: 0,
           minCharacterFName: 2,
           maxCharacterFName: 50

        }
    },
    methods: {
        charCount: function(){

            this.totalcharacter = this.message.length;

        },
        fNameCharCount(){
            this.totalFNameCharacter = this.first_name.length;
        },
        resetFormValues(){
            this.first_name = "";
            this.email = "";
            this.message = "";

            this.totalcharacter = 0;
            this.totalFNameCharacter = 0;
        },
        handleSubmit(){

            if(this.first_name !== ""){

                if(this.email !== ""){

                    if(this.message !== ""){

                        let firstName = document.getElementById('first_name');
                        let email = document.getElementById('email');
                        let message = document.getElementById('message');

                        firstName.classList.remove('input-error');
                        email.classList.remove('input-error');
                        message.classList.remove('input-error');

                        let message_result = document.getElementById('message_result');
                        message_result.classList.remove('show');

                        // Make api request here

                            axios.post('/addPost', {
                                'first_name': this.first_name,
                                'email': this.email,
                                'message': this.message
                            }).then((res) => {

                               console.log(res);
                               alert(res.data.message);

                               this.first_name = "";
                               this.email = "";
                               this.message = "";

                               this.totalcharacter = 0;
                               this.totalFNameCharacter = 0;

                            }).catch(function (error){
                               alert(error);
                            });


                    } else {
                        let message = document.getElementById('message');
                        message.classList.add('input-error');

                        let message_result = document.getElementById('message_result');

                        message_result.classList.add('show');
                        message_result.innerHTML = "Please enter your questions or comments";

                    }

                } else {
                    let email = document.getElementById('email');
                    email.classList.add('input-error');

                    let message_result = document.getElementById('message_result');
                    message_result.classList.add('show');
                    message_result.innerHTML = "Please enter your email. Please make sure it includes an @ symbol with a valid email address.";
                }

            } else {
                let firstName = document.getElementById('first_name');
                let message_result = document.getElementById('message_result');

                message_result.classList.add('show');
                message_result.innerHTML = "Please enter your name";

                firstName.classList.add('input-error');
            }

        }
    }
}
</script>

<style scoped>
.shadow {
    -moz-box-shadow:    inset 0 0 10px #000000;
    -webkit-box-shadow: inset 0 0 10px #000000;
    box-shadow:         inset 0 0 10px #000000;
    background-color: white;
    border-radius: 25px;
}
.image-size {
    width: 20px;
    height: 20px;
    margin-top: 4px;
    float: right;
}
.input-error{
    background-color: #f9cebd;
    border: 1px solid orange;
}
</style>
