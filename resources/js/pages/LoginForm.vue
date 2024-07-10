<template>
    <div class="login-form">
        <h2>Login</h2>
        <form @submit.prevent="submitForm">
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium" for="email">E-mail:</label>
                <input class="w-full p-2 border rounded shadow-sm focus:ring-2 focus:ring-blue-500" name="email" type="email" id="email" v-model="email" required>
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium" for="password">Senha:</label>
                <input class="w-full p-2 border rounded shadow-sm focus:ring-2 focus:ring-blue-500" name="password" type="password" id="password" v-model="password" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white font-medium p-2 rounded shadow-sm hover:bg-blue-600">Enviar</button>

            <div style="margin: 10px 0;padding: 4px" v-if="messageError" class="p-invalid">{{ messageError }}</div>
        </form>
        <br />
        <br />
        <a href="/remember-password" class="bg-blue-500 text-white font-medium p-2 rounded shadow-sm hover:bg-blue-600">Esqueci minha senha</a>
        <a style="float: right;" href="/register" class="bg-blue-500 text-white font-medium p-2 rounded shadow-sm hover:bg-blue-600">Cadastrar</a>

    </div>
</template>

<script>
export default {
    data() {
        return {
            email: '',
            password: '',
            messageError: ''
        }
    },
    methods: {
        submitForm() {
            axios.post('/api/login', {
                email: this.email,
                password: this.password
            })
            .then(response => {
                this.messageError = null;

                localStorage.setItem('APP_USER_TOKEN', response.data.access_token);

                this.$router.push('/home')
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

.form-group label {
    display: block;
    margin-bottom: 5px;
}

.form-group input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.p-invalid{
	border: 2px solid rgba(243, 66, 66, 0.5) !important;
    color: red;
}

</style>
