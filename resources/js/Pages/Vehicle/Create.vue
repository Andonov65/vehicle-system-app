<template>
    <Head title="Create Vehicle"/>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form @submit.prevent="submit">
                        <div>
                            <label for="brand_model_id">Vehicle Brand Model</label>
                            <select
                                v-model="brand_selected.brand_models"
                                type="text">
                                <option v-for="brand in brand_models" :value="brand.brand_models">
                                    {{ brand.name }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="brand_model_id">Vehicle Brand Model</label>
                            <select
                                name="brand_model_id"
                                id="brand_model_id"
                                type="text"
                                v-model="form.brand_model_id">
                                <option v-for="brand_model in brand_selected.brand_models" :value="brand_model.id">
                                    {{ brand_model.name }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="chassis_number">Vehicle Chassis Number</label>
                            <input
                                name="chassis_number"
                                id="chassis_number"
                                type="text"
                                v-model="form.chassis_number"/>
                        </div>
                        <div>
                            <label for="title">Vehicle Title</label>
                            <input
                                name="title"
                                id="title"
                                type="text"
                                v-model="form.title"/>
                        </div>
                        <div>
                            <label for="details">Vehicle Details</label>
                            <input
                                name="details"
                                id="details"
                                type="text"
                                v-model="form.details"/>
                        </div>
                        <div class="mt-4">
                            <label for="image">Vehicle Image</label>
                            <input
                                name="image"
                                id="image"
                                type="file"
                                ref="photo"
                                @change="handleChange"/>
                        </div>
                        <div class="flex items-center mt-4">
                            <button type="submit">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";

export default {
    name: 'Create',
    props: {
        brand_models: Array
    },
    data() {
        return {
            brand_selected: '',
        }
    },
    setup() {
        const form = useForm({
            brand_model_id: null,
            chassis_number: null,
            title: null,
            details: null,
            image: null,
        });

        const brand_selected = useForm({
           brand_models: '',
        });


        const submit = () => {
            form.post(route("vehicles.store"));
        }

        const handleChange = (e) => {
            const file = e.target.files[0];
            if (!file) return;
            form.image = file;
        }

        return {form, submit, handleChange, brand_selected};
    }
};
</script>
