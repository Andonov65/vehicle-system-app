<template>
    <Head title="Product"/>
    <div>
        <Link :href="route('vehicles.create')" class="text-sm text-gray-700 dark:text-gray-500 underline">
            Create New Vehicle
        </Link>
    </div>
    <div>
        <table class="table border-4 text-center">
            <tr class="table-row text-center">
                <th class=" border-4 columns-3">
                    Vehicle Chassis Number
                </th>
                <th class=" border-4 columns-3">
                    Vehicle Title
                </th>
                <th class=" border-4 columns-3">
                    Vehicle Details
                </th>
                <th class=" border-4 columns-3">
                    Vehicle Image
                </th>
                <th class=" border-4 columns-3">
                </th>
            </tr>
            <tr v-for="vehicle in vehicles.data" :key="vehicle.id" class="table-row">
                <td class="table-cell border-4">
                    {{ vehicle.chassis_number }}
                </td>
                <td class="table-cell border-4">
                    {{ vehicle.title }}
                </td>
                <td class="table-cell border-4">
                    {{ vehicle.details }}
                </td>
                <td class="table-cell border-4">
                    <img v-if="vehicle.image.charAt(0) === 'd' " :src="vehicle.image"/>
                    <img v-if="vehicle.image.charAt(0) !== 'd' " :src="'http://127.0.0.1:8000/storage/'+vehicle.image"/>
                </td>
                <td class="table-cell border-4">
                    <Link :href="route('vehicles.edit', vehicle.id)"
                          class="text-sm text-gray-700 dark:text-gray-500 underline">
                        Edit
                    </Link>
                    <Link method="DELETE" type="button" as="button" :href="route('vehicles.destroy', vehicle.id)">
                        Delete
                    </Link>
                </td>
            </tr>
        </table>
    </div>
</template>

<script setup>
import {Head, Link} from '@inertiajs/inertia-vue3';

defineProps({
    vehicles: Array,
});
</script>
