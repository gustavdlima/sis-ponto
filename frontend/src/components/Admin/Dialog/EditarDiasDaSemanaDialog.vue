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
      <div class="grid grid-cols-2">
        <div class="col-span-1">
          <div class="grid grid-rows-1">
            <div class="row-span-1">
              <div class="grid grid-rows-2 ">
                <div class="row-span-1">
                  <label class="text-black text-lg font-semibold p-1">Tabela de horário semanal de {{ props.funcionario.nome }}</label>
                </div>
                <div class="row-span-1">
                  <label class="text-black text-lg font-semibold p-1"> {{ props.funcionario.carga_horaria }} </label>
                </div>
              </div>
            </div>
            <div class="row-span-1">
              <TabelaHorarioSemanalFuncionario
                :arrayHorarioSemanal="props.arrayHorarioSemanal"
                :funcionario="props.funcionario"
                />
            </div>
          </div>
        </div>
        <div class="col-span-1">
          <div class="grid justify-center h-full w-full">
            <div class="grid grid-rows-6">
              <div class="row-span-1 p-1">
                <label class="text-black text-lg font-semibold">Editar Horários</label>
              </div>
              <div class="row-span-1 p-1">
                <div class="grid justify-center w-full">
                  <Dropdown
                        v-model="diasDaSemana.segunda"
                        showClear
                        :options="horario"
                        optionLabel="name"
                        optionValue="code"
                        placeholder="Segunda-Feira"
                        class="w-full lg:w-[12rem] 2xl:w-[13rem] h-[2.5rem]"
                      />
                </div>
              </div>
              <div class="row-span-1 p-1">
                <div class="grid justify-center">
                  <Dropdown
                        v-model="diasDaSemana.terca"
                        showClear
                        :options="horario"
                        optionLabel="name"
                        optionValue="code"
                        placeholder="Terça-Feira"
                        class="w-full lg:w-[12rem] 2xl:w-[13rem] h-[2.5rem]"
                      />
                </div>
              </div>
              <div class="row-span-1 p-1">
                <div class="grid justify-center">
                  <Dropdown
                        v-model="diasDaSemana.quarta"
                        showClear
                        :options="horario"
                        optionLabel="name"
                        optionValue="code"
                        placeholder="Quarta-Feira"
                        class="w-full lg:w-[12rem] 2xl:w-[13rem] h-[2.5rem]"
                      />
                </div>
              </div>
              <div class="row-span-1 p-1">
                <div class="grid justify-center">
                  <Dropdown
                        v-model="diasDaSemana.quinta"
                        showClear
                        :options="horario"
                        optionLabel="name"
                        optionValue="code"
                        placeholder="Quinta-Feira"
                        class="w-full lg:w-[12rem] 2xl:w-[13rem] h-[2.5rem]"
                      />
                </div>
              </div>
              <div class="row-span-1 p-1">
                <div class="grid justify-center">
                  <Dropdown
                        v-model="diasDaSemana.sexta"
                        showClear
                        :options="horario"
                        optionLabel="name"
                        optionValue="code"
                        placeholder="Sexta-Feira"
                        class="w-full lg:w-[12rem] 2xl:w-[13rem] h-[2.5rem]"
                      />
                </div>
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
import TabelaHorarioSemanalFuncionario from "../Tabelas/Listar/TabelaHorarioSemanalFuncionario..vue";

const emit = defineEmits(["atualizarDialogEditarDiasDaSemanaBool"]);
const props = defineProps({
  isVisible: Boolean,
  funcionario: Object,
  diasDaSemana: Object,
  arrayHorarioSemanal: Array,
});
const dialogEditarDiasDaSemanaIsVisible = ref(false);
const dialogMensagem = ref("");
const dialogVisivel = ref(false);
const funcionarioEditado = ref();
const diasDaSemanaEditado = ref();
const horario = ref([]);

const editarDiasDaSemana = async () => {
  diasDaSemanaEditado.value = substituirNenhumPorNull(
    diasDaSemanaEditado.value
  );
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
    console.log(responseEditarFuncionario);
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

const substituirNenhumPorNull = (diasDaSemana) => {
  if (diasDaSemana.segunda == "Nenhum") {
    diasDaSemana.segunda = null;
  }
  if (diasDaSemana.terca == "Nenhum") {
    diasDaSemana.terca = null;
  }
  if (diasDaSemana.quarta == "Nenhum") {
    diasDaSemana.quarta = null;
  }
  if (diasDaSemana.quinta == "Nenhum") {
    diasDaSemana.quinta = null;
  }
  if (diasDaSemana.sexta == "Nenhum") {
    diasDaSemana.sexta = null;
  }
  return diasDaSemana;
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
  horario.value.push({
    name: "Nenhum",
    code: "Nenhum",
  });
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
