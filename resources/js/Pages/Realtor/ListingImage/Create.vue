<template>
    <Box>
        <template #header>Upload New Images </template>
        <form @submit.prevent="upload">
            <section class="flex items-center gap-2 my-4">
                <input
                    class="border rounded-md file:px-4 file:py-2 border-gray-200 dark:border-gray-700 file:text-gray-700 file:dark:text-gray-400 file:border-0 file:bg-gray-100 file:dark:bg-gray-800 file:font-medium file:hover:bg-gray-200 file:dark:hover:bg-gray-700 file:hover:cursor-pointer file:mr-4"
                    multiple
                    type="file"
                    accept="image/*"
                    @input="addFiles"
                />
                <button
                    type="submit"
                    class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed"
                    :disabled="!canUpload"
                >
                    Upload
                </button>
                <button type="reset" class="btn-outline" @click="reset">
                    Reset
                </button>
            </section>
            <div v-if="imageErrors.length" class="input-error">
                <div
                    v-for="(error, index) in imageErrors"
                    :key="index"
                    class="whitespace-pre-line"
                >
                    {{ error }}
                </div>
            </div>
        </form>
    </Box>

    <Box v-if="listing.images.length" class="mt-4">
        <template #header>Current Listing Images</template>
        <section class="mt-4 grid grid-cols-3 gap-4">
            <div
                v-for="image in listing.images"
                :key="image.id"
                class="flex flex-col justify-between"
            >
                <img :src="image.src" class="rounded-md" />
                <Link
                    :href="
                        route('realtor.listing.image.destroy', {
                            listing: props.listing.id,
                            image: image.id,
                        })
                    "
                    method="delete"
                    as="button"
                    class="mt-2 btn-outline text-xs"
                >
                    Delete
                </Link>
            </div>
        </section>
    </Box>
</template>

<script setup>
import Box from "@/Components/UI/Box.vue";
import { Link, router, useForm } from "@inertiajs/vue3";
import NProgress from "nprogress";
import { computed } from "vue";

const props = defineProps({ listing: Object });
router.on("progress", (event) => {
    if (event.detail.progress.percentage) {
        NProgress.set((event.detail.progress.percentage / 100) * 0.9);
    }
});

const form = useForm({
    images: [],
});
const MAX_FILE_SIZE_BYTES = 5 * 1024 * 1024; // 5 MB per file
const MAX_TOTAL_SIZE_BYTES = 8 * 1024 * 1024; // 8 MB total guard
// Option 1: Use newlines consistently
const imageErrors = computed(
    () =>
        Object.values(form.errors).flatMap((err) =>
            err.split("\n").filter(Boolean)
        ),
    {
        onSuccess: () => {
            form.reset("images");
            NProgress.done();
        },
        onError: () => {
            NProgress.done();
        },
        onFinish: () => {
            NProgress.done();
        },
    }
);

const addFiles = (event) => {
    // reset previous image errors
    form.clearErrors("images");

    let total = form.images.reduce((acc, f) => acc + (f?.size || 0), 0);
    const errors = [];

    for (const image of event.target.files) {
        if (total + image.size > MAX_TOTAL_SIZE_BYTES) {
            errors.push(
                `Total size must be ${Math.floor(
                    MAX_TOTAL_SIZE_BYTES / (1024 * 1024)
                )} MB or smaller.`
            );
            continue;
        }
        if (image.size > MAX_FILE_SIZE_BYTES) {
            errors.push("Each file must be 5 MB or smaller.");
            continue;
        }
        if (!image.type.startsWith("image/")) {
            errors.push("Only image files are allowed.");
            continue;
        }
        form.images.push(image);
        total += image.size;
    }
    // Set all accumulated errors at once
    if (errors.length) {
        form.setError("images", [...new Set(errors)].join("\n"));
    }
    // if none passed validation, clear the input selection
    if (!form.images.length) {
        event.target.value = "";
    }
};
const reset = () => form.reset("images");
</script>
