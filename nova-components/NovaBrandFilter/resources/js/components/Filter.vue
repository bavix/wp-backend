<template>
    <div>
        <h3 class="text-sm uppercase tracking-wide text-80 bg-30 p-3">{{ filter.name }}</h3>

        <div class="p-2">
            <v-select @input="handleChange"
                      :dusk="filter.name + '-filter-select'"
                      :options="filter.options"
                      :value="value"
                      label="name">

                <template slot="option" slot-scope="option">
                    <span class="inline-block rounded-full w-2 h-2 bg-success"></span>
                    {{ option.name }}
                    <span class="pull-right--bx">{{ option.wheels_count }}</span>
                </template>
            </v-select>
        </div>
    </div>
</template>

<script>
  import vSelect from 'vue-select'

  export default {
    components: {
      'v-select': vSelect,
    },

    props: {
      resourceName: {
        type: String,
        required: true,
      },
      filterKey: {
        type: String,
        required: true,
      },
    },

    methods: {
      handleChange(option) {
        this.$store.commit(`${this.resourceName}/updateFilterState`, {
          filterClass: this.filterKey,
          value: option.value,
        })

        this.$emit('change')
      },
    },

    computed: {
      filter() {
        return this.$store.getters[`${this.resourceName}/getFilter`](this.filterKey)
      },

      value() {
        return this.filter.options
          .find(({value}) => this.filter.currentValue === value);
      },
    },
  }
</script>
