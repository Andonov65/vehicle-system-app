<template>
    <Head title="Create Vehicle"/>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form @submit.prevent="submit">
                        <div>
                            <label for="brand_model_id">Vehicle Brand</label>
                            <input :value="brand.name" style="color: gray" type="text" disabled>
                        </div>
                        <div>
                            <label for="brand_model_id">Vehicle Brand Model</label>
                            <select
                                name="brand_model_id"
                                id="brand_model_id"
                                type="text"
                                v-model="form.brand_model_id">
                                <option v-for="brand_model in brand_models" :value="brand_model.id">
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
        brand_models: Array,
        vehicle: Object,
        brand: Object,
    },
    setup(props) {
        const form = useForm({
            _method:"PUT",
            brand_model_id: props.vehicle.brand_model_id,
            chassis_number: props.vehicle.chassis_number,
            title: props.vehicle.title,
            details: props.vehicle.details,
            image: null,
        });

        const submit = ()=>
        {
            form.post(route("vehicles.update", props.vehicle));
        }

        const handleChange = (e) =>{
            const file = e.target.files[0];
            if(!file) return;
            form.image = file;
        }

        return {form, submit, handleChange};
    }
};
</script>
