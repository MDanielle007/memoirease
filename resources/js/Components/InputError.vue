<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<template>
    <div v-show="message">
        <Message severity="error" variant="simple" size="small" >
            <sup>{{ message }}</sup>
        </Message>
    </div>
</template>
