<template>
    <p>
        <img
                v-if="field.thumbnailUrl"
                :src="field.thumbnailUrl"
                style="object-fit: cover;"
                class="align-bottom rounded-full w-8 h-8 size-xl"
        />
        <span v-else>&mdash;</span>
    </p>
</template>

<script>
  export default {
    props: ['viaResource', 'viaResourceId', 'resourceName', 'field'],
  }
</script>
