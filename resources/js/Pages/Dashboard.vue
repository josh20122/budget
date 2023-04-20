<template>
  <!-- Modal toggle -->
  <div class="px-2 md:px-32 md:mt-20 mt-6">
    <div class="mb-4 grid justify-end">
      <button
        @click="modal = true"
        data-modal-target="authentication-modal"
        data-modal-toggle="authentication-modal"
        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        type="button"
      >
        Create Item
      </button>
    </div>

    <Modal :show="modal" @close="modal = false">
      <div class="font-bold flex justify-between p-2 pt-5">
        <span>Create Item </span>
        <span class=" " @click="modal = false">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 18L18 6M6 6l12 12"
            />
          </svg>
        </span>
      </div>
      <div>
        <div class="px-2 pb-6 w-full grid md:grid-cols-2 gap-4">
          <div>
            <InputLabel> Item name</InputLabel>
            <Textinput
              type="text"
              v-model="form.name"
              class="w-full"
              placeholder="Enter item name"
            ></Textinput>
            <InputError :message="errors.name"></InputError>
          </div>
          <div>
            <InputLabel>Price/item in $ </InputLabel>
            <Textinput
              type="number"
              v-model="form.price"
              class="w-full"
              placeholder="Enter item name"
            ></Textinput>
            <InputError :message="errors.price"></InputError>
          </div>
          <div>
            <InputLabel>Amount of items </InputLabel>
            <Textinput
              type="number"
              class="w-full"
              v-model="form.amount"
              placeholder="Enter item name"
            ></Textinput>
            <InputError :message="errors.amount"></InputError>
          </div>
          <div
            v-if="
              this.form.name.length > 0 &&
              this.form.price.length > 0 &&
              this.form.amount.length > 0
            "
          >
            <InputLabel>Total amount in $ </InputLabel>
            <Textinput
              type="text"
              class="w-full"
              :value="total"
              readonly
              placeholder="Enter item name"
            ></Textinput>
          </div>
        </div>
      </div>
      <div class="mb-6 px-2">
        <button
          @click="updateItem(form.id)"
          class="btn btn-primary w-full"
          v-text="'update item'"
          v-if="update"
        ></button>
        <button
          @click="submit()"
          class="btn btn-primary w-full"
          v-text="'create item'"
          v-else
        ></button>
      </div>
    </Modal>

    <div class="overflow-x-auto">
      <table class="table w-full">
        <!-- head -->
        <thead>
          <tr>
            <th></th>
            <th>Item name</th>
            <th>Amount</th>

            <th>Price</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- row 1 -->

          <tr v-for="(item, index) in items" :key="index">
            <th v-text="index + 1"></th>

            <td v-text="item.name"></td>
            <td v-text="item.amount"></td>
            <td v-text="item.amount * item.price"></td>
            <td>
              <div class="inline-flex gap-x-2">
                <button
                  @click="edit(item.id)"
                  class="btn btn-circle btn-primary btn-sm"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    class="bi bi-pencil"
                    viewBox="0 0 16 16"
                  >
                    <path
                      d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"
                    />
                  </svg>
                </button>
                <Link :href="`/items/${item.id}`" method="delete">
                  <button class="btn btn-circle btn-error btn-sm">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="16"
                      height="16"
                      fill="currentColor"
                      class="bi bi-trash3-fill"
                      viewBox="0 0 16 16"
                    >
                      <path
                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"
                      />
                    </svg>
                  </button>
                </Link>
              </div>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3">Total</td>
            <td colspan="2">{{ getTotal() }}</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</template>
<script >
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import Textinput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "../Components/Modal.vue";
import { Link } from "@inertiajs/vue3";
export default {
  layout: AppLayout,
  props: ["errors", "items"],
  components: { Link, Modal, Textinput, Welcome, InputError, InputLabel },
  data() {
    return {
      modal: false,
      update: false,

      form: {
        id: null,
        name: "",
        price: "",
        amount: "",
      },
    };
  },
  watch: {
    modal(newvalue) {
      if (newvalue == false) {
        this.form.name = "";
        this.form.price = null;
        this.form.amount = null;
        this.update = false;
      }
    },
  },
  computed: {
    total() {
      if (
        this.form.name != null &&
        this.form.price != null &&
        this.form.amount != null
      ) {
        return parseInt(this.form.amount) * parseInt(this.form.price);
      }
    },
  },
  methods: {
    getTotal() {
      let total = 0;
      for (let i = 0; i < this.items.length; i++) {
        total += this.items[i].price * this.items[i].amount;
      }
      return total;
    },
    edit(id) {
      for (let i = 0; i < this.items.length; i++) {
        if (this.items[i].id == id) {
          this.form.name = this.items[i].name;
          this.form.price = this.items[i].price;
          this.form.amount = this.items[i].amount;
          this.modal = true;
          this.update = true;
          this.form.id = id;
        }
      }
    },
    updateItem(id) {
      this.$inertia.put("/items/" + id, this.form, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          this.modal = false;
        },
      });
    },
    submit() {
      this.$inertia.post("/items", this.form, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          this.modal = false;
        },
      });
    },
  },
};
</script>

