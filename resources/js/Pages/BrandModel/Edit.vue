<template>
    <Head title="Brand Model"/>
    <div>
        <form @submit.prevent="submit">
            <div>
                <label for="name">Brand Model Name</label>
                <input
                    name="name"
                    id="name"
                    type="text"
                    v-model="form.name"/>
            </div>
            <div>
                <label for="brand_id">Vehicle Brand Model</label>
                <select
                    name="brand_id"
                    id="brand_id"
                    type="text"
                    v-model="form.brand_id">
                    <option v-for="brand in brands" :value="brand.id">
                        {{ brand.name }}
                    </option>
                </select>
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
        brandmodel: Object,
        brands: Array
    },
    setup(props) {
        const form = useForm({
            brand_id: props.brandmodel.brand_id,
            name: props.brandmodel.name
        });

        const submit = () => {
            form.put(route("brandmodels.update", props.brandmodel));
        }

        return {form, submit};
    }
};
</script>
