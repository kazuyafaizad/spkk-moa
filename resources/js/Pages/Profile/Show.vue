<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import LogoutOtherBrowserSessionsForm from "@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue";
import SectionBorder from "@/Components/SectionBorder.vue";
import UpdatePasswordForm from "@/Pages/Profile/Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "@/Pages/Profile/Partials/UpdateProfileInformationForm.vue";

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: { type: Array, default: Array },
});
</script>

<template>
    <AppLayout title="Profile">
        <template #header>
            <h2 class="font-semibold text-2xl text-[#3b3f5c]">Profile</h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                    <UpdateProfileInformationForm
                        :user="$page.props.auth.user"
                    />

                    <SectionBorder />
                </div>

                <div v-if="$page.props.jetstream.canUpdatePassword">
                    <UpdatePasswordForm class="mt-10 sm:mt-0" />

                    <SectionBorder />
                </div>

                <LogoutOtherBrowserSessionsForm
                    :sessions="sessions"
                    class="mt-10 sm:mt-0"
                />
            </div>
        </div>
    </AppLayout>
</template>
