<template>
    <Head title="Brand Model"/>
    <div>
        <table>
            <tr>
                <th>Brand Model Name</th>
                <th>Brand Name</th>
                <th></th>
            </tr>
            <tr v-for="brandmodel in brandmodels" :key="brandmodel.id">
                <td>
                    {{ brandmodel.name }}
                </td>
                <td>
                    {{ brandmodel.brand.name }}
                </td>
                <td>
                    <Link :href="route('brandmodels.edit', brandmodel.id)"
                          class="text-sm text-gray-700 dark:text-gray-500 underline">
                        Edit
                    </Link>
                    <Link method="DELETE" type="button" as="button" :href="route('brandmodels.destroy', brandmodel.id)">
                        Delete
                    </Link>
                </td>
            </tr>
        </table>
        <form @submit.prevent="submit">
            <div>
                <label for="name">Brand Name</label>
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
                Add
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
        brandmodels: Array,
        brands: Array
    },
    setup() {
        const form = useForm({
            brand_id: null,
            name: null
        });

        const submit = () => {
            form.post(route("brandmodels.store"),{
                onSuccess: () => {
                    form.reset();
                }
            });
        }

        return {form, submit};
    }
};
</script>
