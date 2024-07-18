<template>
  <Dialog
    v-model:visible="dialogEditarDiasDaSemanaIsVisible"
    @update:visible="fecharEditarDiasDaSemanaDialog"
    modal
    :closable="true"
    :resizable="false"
    :style="{ width: '120vh' }"
  >
    <template #header>
      <div class="grid justify-start w-full">
        <span class="text-blue-950 text-2xl font-semibold">
          Editar Horário Semanal
        </span>
      </div>
    </template>
    <div class="grid justify-center p-1">
      <div class="grid md:grid-cols-2 h-full w-full gap-1">
        <div class="grid md:col-span-1">
          <div class="grid xl:grid-cols-2">
            <div class="col-span-1">
              <div class="grid grid-rows-2 h-full w-full">
                <div class="row-span-1 p-1">
                  <div class="font-semibold">
                    <span>Horário Segunda</span>
                  </div>
                  <Dropdown
                    v-model="diasDaSemana.segunda"
                    showClear
                    :options="horario"
                    optionLabel="name"
                    optionValue="code"
                    placeholder="Segunda-Feira"
                    class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem]"
                  />
                </div>
                <div class="row-span-1 p-1">
                  <div class="font-semibold">
                    <span>Horário Terça</span>
                  </div>
                  <Dropdown
                    v-model="diasDaSemana.terca"
                    showClear
                    :options="horario"
                    optionLabel="name"
                    optionValue="code"
                    placeholder="Terça-Feira"
                    class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem]"
                  />
                </div>
              </div>
            </div>
            <div class="col-span-1">
              <div class="grid grid-rows-2 h-full w-full">
                <div class="row-span-1 p-1">
                  <div class="font-semibold">
                    <span>Horário Quarta</span>
                  </div>
                  <Dropdown
                    v-model="diasDaSemana.quarta"
                    showClear
                    :options="horario"
                    optionLabel="name"
                    optionValue="code"
                    placeholder="Quarta-Feira"
                    class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem]"
                  />
                </div>
                <div class="row-span-1 p-1">
                  <div class="font-semibold">
                    <span>Horário Quinta</span>
                  </div>
                  <Dropdown
                    v-model="diasDaSemana.quinta"
                    showClear
                    :options="horario"
                    optionLabel="name"
                    optionValue="code"
                    placeholder="Quinta-Feira"
                    class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem]"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="grid md:col-span-1">
          <div class="grid xl:grid-cols-2">
            <div class="col-span-1">
              <div class="grid grid-rows-2 h-full w-full">
                <div class="row-span-1 p-1">
                  <div class="font-semibold">
                    <span>Horário Sexta</span>
                  </div>
                  <Dropdown
                    v-model="diasDaSemana.sexta"
                    showClear
                    :options="horario"
                    optionLabel="name"
                    optionValue="code"
                    placeholder="Sexta-Feira"
                    class="w-full xl:w-[14rem] 2xl:w-[18rem] h-[2.5rem]"
                  />
                </div>
                <div class="row-span-1 p-1"></div>
              </div>
            </div>
            <div class="col-span-1">
              <div class="grid grid-rows-2 h-full w-full">
                <div class="row-span-1 p-1"></div>
                <div class="row-span-1 p-1 overflow-hidden"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <template #footer>
      <div class="grid justify-center">
        <Button
          label="Enviar"
          class="p-button-info h-10 w-36 md:w-40 lg:w-44 lg:h-10 text-md md:text-lg"
          @click="editarDiasDaSemana()"
        />
      </div>
    </template>
    <DialogAlerta
      :conteudoPropsDialog="{
        dialogMensagem: dialogMensagem,
        dialogVisivel: dialogVisivel,
      }"
    />
  </Dialog>
</template>

<script setup>
import { ref, watch, onMounted } from "vue";
import Button from "primevue/button";
import Dialog from "primevue/dialog";
import Calendar from "primevue/calendar";
import Dropdown from "primevue/dropdown";
import useListarService from "../../../services/ListarService";
import useCadastroService from "../../../services/CadastroService";
import useEditarService from "../../../services/EditarService";
import useUtils from "../../../services/Utils";
import DialogAlerta from "../../DialogAlerta.vue";

const emit = defineEmits(["atualizarDialogEditarDiasDaSemanaBool"]);
const props = defineProps({
  isVisible: Boolean,
  funcionario: Object,
  diasDaSemana: Object,
});
const dialogEditarDiasDaSemanaIsVisible = ref(false);
const dialogMensagem = ref("");
const dialogVisivel = ref(false);
const funcionarioEditado = ref();
const diasDaSemanaEditado = ref();
const horario = ref([]);

const editarDiasDaSemana = async () => {
  const response = await useCadastroService.cadastrarDiasDaSemana(
    diasDaSemanaEditado.value
  );

  handleResponse(response, response.data.diasDaSemana.id);
};

const handleResponse = async (response, idDiasDaSemana) => {
  if (response.status == 201 || response.status == 200) {
    funcionarioEditado.value.id_dia_da_semana = idDiasDaSemana;
    const responseEditarFuncionario = await useEditarService.editarFuncionario(
      funcionarioEditado.value
    );
    dialogMensagem.value = "Dias da semana editados com sucesso!";
    dialogVisivel.value = true;
    setTimeout(() => {
      dialogVisivel.value = false;
      fecharEditarDiasDaSemanaDialog();
    }, 2000);
  } else {
    dialogMensagem.value = "Erro ao editar dias da semana!";
    dialogVisivel.value = true;
  }
};

const fecharEditarDiasDaSemanaDialog = () => {
  dialogEditarDiasDaSemanaIsVisible.value = false;
  emit(
    "atualizarDialogEditarDiasDaSemanaBool",
    dialogEditarDiasDaSemanaIsVisible.value
  );
};

const getHorarios = async () => {
  const response = await useCadastroService.getHorarios();
  for (let i = 0; i < response.data.length; i++) {
    if (response.data[i].terceiro_horario == null) {
      var horarioString =
        response.data[i].primeiro_horario +
        " - " +
        response.data[i].segundo_horario;
    } else {
      var horarioString =
        response.data[i].primeiro_horario +
        " - " +
        response.data[i].segundo_horario +
        " - " +
        response.data[i].terceiro_horario +
        " - " +
        response.data[i].quarto_horario;
    }
    horario.value.push({
      name: horarioString,
      code: response.data[i].id,
    });
  }
};

watch(props, (newValue) => {
  dialogEditarDiasDaSemanaIsVisible.value = newValue.isVisible;
  funcionarioEditado.value = props.funcionario;
  diasDaSemanaEditado.value = props.diasDaSemana;
});

onMounted(() => {
  getHorarios();
});
</script>

<style scoped>
button {
  background-color: #1f2937 !important;
  border: none !important;
}
</style>
