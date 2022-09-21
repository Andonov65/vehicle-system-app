<template>
    <Head title="Brand Model"/>
    <div>
        <form @submit.prevent="submit">
            <div>
                <label for="name">Brand Name</label>
                <input
                    name="name"
                    id="name"
                    type="text"
                    v-model="form.name"/>
            </div>
            <button type="submit">
                Save
            </button>
        </form>
    </div>
</template>

<script>
import {Head, Link} from "@inertiajs/inertia-vue3";
import {useForm} from "@inertiajs/inertia-vue3";

export default {
    name: 'BrandModel',
    props: {
        brand: Object,
        brands: Array
    },
    setup(props) {
        const form = useForm({
            name: props.brand.name
        });

        const submit = () => {
            form.put(route("brands.update", props.brand));
        }

        return {form, submit};
    }
};
</script>
