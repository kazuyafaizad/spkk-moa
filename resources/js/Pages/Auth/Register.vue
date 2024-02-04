<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const form = useForm({
    name: "",
    email: "",
    password: "",
    ic_no: "",
    password_confirmation: "",
    terms: false,
});

const showPassword = ref(false);

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};

const toggleShow = () => {
    showPassword.value = !showPassword.value;
};
</script>

<template>
    <Head title="Register" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Nama Penuh" class="required" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="email"
                    value="No. Kad Pengenalan"
                    class="required"
                />
                <TextInput
                    id="email"
                    v-model="form.ic_no"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="ic_no"
                />
                <InputError class="mt-2" :message="form.errors.ic_no" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="email"
                    value="E-mel Pengguna"
                    class="required"
                />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type-value="email"
                    class="mt-1 block w-full"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="password"
                    value="Kata Laluan"
                    class="required"
                />
                <TextInput
                    id="password"
                    v-model="form.password"
                    :type-value="showPassword ? 'text' : 'password'"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />

                <div class="flex justify-end" @click="toggleShow">
                    <span class="icon is-small is-right">
                        <i
                            class="bi"
                            :class="{
                                'bi-eye-slash': !showPassword,
                                'bi-eye': showPassword,
                            }"
                        ></i>
                    </span>
                </div>

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="password_confirmation"
                    value="Sahkan Kata Laluan"
                />

                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type-value="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div
                v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
                class="mt-4"
            >
                <InputLabel for="terms">
                    <div class="flex items-center">
                        <Checkbox
                            id="terms"
                            v-model:checked="form.terms"
                            name="terms"
                            required
                        />

                        <div class="ml-2">
                            I agree to the
                            <a
                                target="_blank"
                                :href="route('terms.show')"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >Terms of Service</a
                            >
                            and
                            <a
                                target="_blank"
                                :href="route('policy.show')"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >Privacy Policy</a
                            >
                        </div>
                    </div>
                    <InputError class="mt-2" :message="form.errors.terms" />
                </InputLabel>
            </div>
            <Link
                :href="route('login')"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Sudah Mendaftar?
            </Link>
            <div class="flex items-center justify-end mt-4">
                <PrimaryButton
                    class="w-full"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Daftar
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
<style>
.required:after {
    content: " *";
    color: red;
}
</style>
