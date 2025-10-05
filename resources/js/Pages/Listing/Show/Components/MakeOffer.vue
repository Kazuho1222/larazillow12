<template>
    <Box>
        <template #header>Make an offer</template>
        <div>
            <form>
                <input type="text" v-model.number="form.amount" class="input" />
                <input
                    type="range"
                    :min="min"
                    :max="max"
                    step="1000"
                    v-model.number="form.amount"
                    class="mt-2 w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                />
                <button type="submit" class="btn-outline w-full mt-2 text-sm">
                    Make an offer
                </button>
            </form>
        </div>
        <div class="flex justify-between text-gray-500 mt-2">
            <div>Difference</div>
            <div>
                <Price :price="difference" />
            </div>
        </div>
    </Box>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import Box from "@/Components/UI/Box.vue";
import { computed } from "vue";
import Price from "@/Components/Price.vue";

const props = defineProps({
    listingId: Number,
    price: Number,
});
const form = useForm({
    amount: props.price,
});
const difference = computed(() => form.amount - props.price);
const min = computed(() => props.price / 2);
const max = computed(() => props.price * 2);
</script>
