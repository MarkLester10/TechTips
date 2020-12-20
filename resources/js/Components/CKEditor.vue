<template>
    <div>
        <ckeditor :config="editorConfig" v-model="text"></ckeditor>
    </div>
</template>

<script>
export default {
    props: {
        value: {}
    },
    data() {
        return {
            text: "",
            editorData: "<p>Tell them how awesome your company is.</p>",
            editorConfig: {
                // The configuration of the editor.
            }
        };
    },
    watch: {
        value: {
            immediate: true,
            handler(value) {
                this.text = value;
            }
        },
        text(text) {
            this.$emit("input", text);
        }
    }
};
</script>

<style lang="scss" scoped></style>
