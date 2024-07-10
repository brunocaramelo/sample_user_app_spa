<template>
    <div class="login-form">
        <h2>Novo Cadastro</h2>
        <form @submit.prevent="submitForm">
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium" for="name">Nome:</label class="block mb-2 text-sm font-medium">
                <input class="w-full p-2 border rounded shadow-sm focus:ring-2 focus:ring-blue-500" name="name" type="name" id="name" v-model="name" >
            </div>
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium" for="lastname">Sobrenome:</label class="block mb-2 text-sm font-medium">
                <input class="w-full p-2 border rounded shadow-sm focus:ring-2 focus:ring-blue-500" name="lastname" type="lastname" id="lastname" v-model="lastname" >
            </div>
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium" for="email">E-mail:</label class="block mb-2 text-sm font-medium">
                <input class="w-full p-2 border rounded shadow-sm focus:ring-2 focus:ring-blue-500" name="email" type="email" id="email" v-model="email" >
            </div>
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium" for="password">Senha:</label class="block mb-2 text-sm font-medium">
                <input class="w-full p-2 border rounded shadow-sm focus:ring-2 focus:ring-blue-500" name="password" type="password" id="password" v-model="password" >
            </div>
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium" for="confirm_password">Confirmar Senha:</label class="block mb-2 text-sm font-medium">
                <input class="w-full p-2 border rounded shadow-sm focus:ring-2 focus:ring-blue-500" name="confirm_password" type="password" id="confirm_password" v-model="confirm_password" >
            </div>

            <div class="form-group">
                <label class="block mb-2 text-sm font-medium" for="cep">CEP:</label class="block mb-2 text-sm font-medium">
                <input class="w-full p-2 border rounded shadow-sm focus:ring-2 focus:ring-blue-500" name="cep" type="cep" id="cep" v-model="cep"  @blur="findCepLocation">
            </div>
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium" for="street">Rua:</label class="block mb-2 text-sm font-medium">
                <input class="w-full p-2 border rounded shadow-sm focus:ring-2 focus:ring-blue-500" name="street" type="street" id="street" v-model="street" >
            </div>
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium" for="street_number">Número:</label class="block mb-2 text-sm font-medium">
                <input class="w-full p-2 border rounded shadow-sm focus:ring-2 focus:ring-blue-500" name="street_number" type="street_number" id="street_number" v-model="street_number" >
            </div>
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium" for="neighborhood">Bairro:</label class="block mb-2 text-sm font-medium">
                <input class="w-full p-2 border rounded shadow-sm focus:ring-2 focus:ring-blue-500" name="neighborhood" type="neighborhood" id="neighborhood" v-model="neighborhood" >
            </div>
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium" for="city">Cidade:</label class="block mb-2 text-sm font-medium">
                <input class="w-full p-2 border rounded shadow-sm focus:ring-2 focus:ring-blue-500" name="city" type="city" id="city" v-model="city" >
            </div>
            <div class="form-group">
                <label class="block mb-2 text-sm font-medium" for="state">Estado:</label class="block mb-2 text-sm font-medium">
                <input class="w-full p-2 border rounded shadow-sm focus:ring-2 focus:ring-blue-500" name="state" type="state" id="state" v-model="state" >
            </div>

            <button type="submit" class="bg-blue-500 text-white font-medium p-2 rounded shadow-sm hover:bg-blue-600">Enviar</button>

            <div style="margin: 10px 0;padding: 4px" v-if="messageError" class="p-invalid">{{ messageError }}</div>
            <div style="margin: 10px 0;padding: 4px" v-if="messageSuccess" class="p-valid">{{ messageSuccess }}</div>

            <a style="float:right" href="/login" class="bg-blue-500 text-white font-medium p-2 rounded shadow-sm hover:bg-blue-600">Voltar</a>

        </form>


    </div>
</template>

<script>
export default {
    data() {
        return {
            name: '',
            password: '',
            confirm_password: '',
            email: '',
            lastname: '',
            cep: '',
            street: '',
            city: '',
            street_number: '',
            state: '',
            neighborhood: '',
            messageError: ''
        }
    },
    methods: {
        findCepLocation(){
            axios.get('/api/address/search/'+this.cep, {}
            )
            .then(response => {
                this.messageError = null;

                this.street = response.data.data.street;
                this.city = response.data.data.city;
                this.state = response.data.data.state;
                this.neighborhood = response.data.data.neighborhood;
            })
            .catch(error => {
                this.messageError = error.response.data.message;
            })
        },
        submitForm() {
            axios.post('/api/register', {
                name: this.name,
                password: this.password,
                confirm_password: this.confirm_password,
                email: this.email,
                lastname: this.lastname,
                cep: this.cep,
                street: this.street,
                city: this.city,
                street_number: this.street_number,
                state: this.state,
                neighborhood: this.neighborhood,
            })
            .then(response => {
                this.messageError = null;

                this.messageSuccess = response.data.message+' ..redirecionando para login';

                setTimeout(() => {
                    this.$router.push('/login')
                }, 2000);

            })
            .catch(error => {

                const responseApi = error.response.data;

                this.messageError = responseApi.message;

                if(responseApi.errors) {
                    for (const [key, value] of Object.entries(responseApi.errors)) {
                        document.querySelector(`[name=${key}]`)
                                ?.classList.add("p-invalid");

                    }
                }

            })
        }
    }
}
</script>

<style scooped>
.login-form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label class="block mb-2 text-sm font-medium" {
    display: block;
    margin-bottom: 5px;
}

.form-group input class="w-full p-2 border rounded shadow-sm focus:ring-2 focus:ring-blue-500" {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.p-invalid{
	border: 2px solid rgba(243, 66, 66, 0.5) !important;
    color: red;
}

.p-valid{
	border: 2px solid green !important;
    color: green;
}

</style>
