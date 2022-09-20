<template>
    <Head title="Brand"/>
    <div>
        <table>
            <tr>
                <th>Brand Name</th>
                <th></th>
            </tr>
            <tr v-for="brand in brands" :key="brand.id">
                <td>
                    {{brand.name}}
                </td>
                <td>
                    <Link :href="route('brand.edit', brand.id)"
                          class="text-sm text-gray-700 dark:text-gray-500 underline">
                        Edit
                    </Link>
                    <Link method="DELETE" type="button" as="button" :href="route('brand.destroy', brand.id)">
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
                <button type="submit">
                    Add
                </button>
            </div>

        </form>
    </div>
</template>

<script>
import {Head, Link } from "@inertiajs/inertia-vue3";
import {useForm} from "@inertiajs/inertia-vue3";

export default {
    name: 'Brand',
    props: {
        brands: Array
    },
    setup() {
        const form = useForm({
            name: null
        });

        const submit = ()=>
        {
            form.post(route("brand.store"));
        }

        return {form, submit};
    }
};
</script>
