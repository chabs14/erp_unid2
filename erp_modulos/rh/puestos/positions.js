document.addEventListener(
  "DOMContentLoaded",
  async () => {
    const newPosition = document.querySelector("#newPosition");
    const form = document.querySelector("#form-pos");
    const submit = document.querySelector("#submit");

    const reset = () => {
      document.querySelectorAll("form").forEach((form) => {
        form.reset();
      });
      $(".day").collapse("hide");
      $(".turn").collapse("hide");
      $("#days button").prop("disabled", false);
    };

    newPosition.addEventListener("click", (event) => {
      reset();
      const label = document.querySelector("#submit-label");
      submit.setAttribute("data-method", "submit");
      form.setAttribute("data", "");
      label.innerHTML = `Insertar nueva posición de trabajo`;
    });

    const table = document.querySelector("#table-pos");

    await axios
      .get(`http://${window.location.hostname}/erp_modulos/rh/Api/positions`)
      .then((response) => {
        const rows = response.data.map(
          (data, id) =>
            `<tr style="text-align: justify">
                 <th scope="row" style="text-align: center" id=${id}>${
              id + 1
            }</th>
                 <td data=${data.id}>${data.positionName}</td>
                 <td data=${data.id}>${data.departmentName}</td>
                 <td data=${data.id}>${
              data.positionIsSupervisor == 0 ? "&#10006" : "&#10004"
            }</td>
                 <td> 
                 <button class="btn btn-sm btn-outline-primary" id="btn-edit" data-toggle="modal" data-name="${
                   data.positionName
                 }" data-tip="tooltip" title="Editar" data-target="#modal-submit" data=${
              data.id
            }>Editar</button>
                 <button class="btn btn-sm btn-outline-danger" id="btn-delete" data-toggle="modal" data-name="${
                   data.positionName
                 }" data-tip="tooltip" title="Eliminar" data-target="#modal-delete" data=${
              data.id
            }>Eliminar</button>
                 </td>
                 </tr>`
        );
        table.innerHTML += rows.join("");
        $("#table-pos").bootstrapTable({
          pagination: true,
          search: true,
        });
        $('[data-tip="tooltip"]').tooltip();
      })
      .catch((e) => {
        console.log(e);
      });

    await axios
      .get(`http://${window.location.hostname}/erp_modulos/rh/Api/departments`)
      .then((response) => {
        const data = response.data;
        const rows = data.map(
          (option) => `<option value="${option.id}">${option.name}</option>`
        );
        const element = document.querySelector(`#positionDepartment`);
        const edit_element = document.querySelector(`#positionDepartment`);
        element.innerHTML = rows.join("");
        edit_element.innerHTML = rows.join("");
        $("#positionDepartment").selectpicker({
          liveSearch: true,
          liveSearchNormalize: true,
          size: 5,
        });
        $("#edit-positionDepartment").selectpicker({
          liveSearch: true,
          liveSearchNormalize: true,
          size: 5,
        });
      })
      .catch((e) => {
        console.log(e);
      });

    const sundaySchedule_form = document.querySelector("#sundaySchedule-form");
    const mondaySchedule_form = document.querySelector("#mondaySchedule-form");
    const tuesdaySchedule_form = document.querySelector(
      "#tuesdaySchedule-form"
    );
    const wednesdaySchedule_form = document.querySelector(
      "#wednesdaySchedule-form"
    );
    const thursdaySchedule_form = document.querySelector(
      "#thursdaySchedule-form"
    );
    const fridaySchedule_form = document.querySelector("#fridaySchedule-form");
    const saturdaySchedule_form = document.querySelector(
      "#saturdaySchedule-form"
    );

    const postData = (form_data) => {
      const data = Object.fromEntries(form_data);
      data.positionIsSupervisor = data.positionIsSupervisor
        ? data.positionIsSupervisor
        : 0;
      data.positionSchedule = {};
      data.positionSchedule.sundaySchedule = Object.fromEntries(
        new FormData(sundaySchedule_form)
      );
      data.positionSchedule.mondaySchedule = Object.fromEntries(
        new FormData(mondaySchedule_form)
      );
      data.positionSchedule.tuesdaySchedule = Object.fromEntries(
        new FormData(tuesdaySchedule_form)
      );
      data.positionSchedule.wednesdaySchedule = Object.fromEntries(
        new FormData(wednesdaySchedule_form)
      );
      data.positionSchedule.thursdaySchedule = Object.fromEntries(
        new FormData(thursdaySchedule_form)
      );
      data.positionSchedule.fridaySchedule = Object.fromEntries(
        new FormData(fridaySchedule_form)
      );
      data.positionSchedule.saturdaySchedule = Object.fromEntries(
        new FormData(saturdaySchedule_form)
      );

      axios
        .post(
          `http://${window.location.hostname}/erp_modulos/rh/Api/positions`,
          data
        )
        .then((response) => {
          if (response.data !== 0) {
            Swal.fire({
              title: 'Puesto creado!',
              icon: 'success'
          })
            location.reload();
          }
        })
        .catch((e) => {
          handleErrors({ form: "form-pos", data: e.response.data });
        });
    };

    const updateData = (form_data, id) => {
      const data = Object.fromEntries(form_data);
      data.positionIsSupervisor = data.positionIsSupervisor
        ? data.positionIsSupervisor
        : 0;
      console.log(data);
      data.positionSchedule = {};
      data.positionSchedule.sundaySchedule = Object.fromEntries(
        new FormData(sundaySchedule_form)
      );
      data.positionSchedule.mondaySchedule = Object.fromEntries(
        new FormData(mondaySchedule_form)
      );
      data.positionSchedule.tuesdaySchedule = Object.fromEntries(
        new FormData(tuesdaySchedule_form)
      );
      data.positionSchedule.wednesdaySchedule = Object.fromEntries(
        new FormData(wednesdaySchedule_form)
      );
      data.positionSchedule.thursdaySchedule = Object.fromEntries(
        new FormData(thursdaySchedule_form)
      );
      data.positionSchedule.fridaySchedule = Object.fromEntries(
        new FormData(fridaySchedule_form)
      );
      data.positionSchedule.saturdaySchedule = Object.fromEntries(
        new FormData(saturdaySchedule_form)
      );
      data.positionIsSupervisor = data.positionIsSupervisor
        ? data.positionIsSupervisor
        : 0;

      axios
        .put(
          `http://${window.location.hostname}/erp_modulos/rh/Api/positions/${id}`,
          data
        )
        .then((response) => {
          if (response.data === 0) {
            Swal.fire({
              title: 'No se han modificado los datos',
              icon: 'warning'
          })
          } else {
            Swal.fire({
              title: 'Puesto actualizado!',
              icon: 'success'
          })
            location.reload();
          }
        })
        .catch((e) => {
          handleErrors({ form: "form-pos", data: e.response.data });
        });
    };

    submit.addEventListener("click", (event) => {
      const method = submit.getAttribute("data-method");
      const form_data = new FormData(form);
      switch (method) {
        case "submit":
          postData(form_data);
          break;
        case "edit":
          const id = form.getAttribute("data");
          updateData(form_data, id);
          break;
      }
    });

    const btn_delete_yes = document.querySelector("#modal-btn-si");

    btn_delete_yes.addEventListener("click", (event) => {
      const id = btn_delete_yes.getAttribute("data");
      axios
        .delete(
          `http://${window.location.hostname}/erp_modulos/rh/Api/positions/${id}`
        )
        .then((response) => {
          if (response.data === 1) {
            Swal.fire({
              title: 'Puesto Eliminado!',
              icon: 'success'
          })
            location.reload();
          }
        })
        .catch((e) => {
          console.log(e);
        });
    });

    const btn_delete = document.querySelectorAll("#btn-delete");

    btn_delete.forEach((btn) => {
      const id = btn.getAttribute("data");
      const name = btn.getAttribute("data-name");
      btn.addEventListener("click", (event) => {
        btn_delete_yes.setAttribute("data", id);
        const label = document.querySelector("#confirm-label");
        label.innerHTML = `¿Eliminar ${name}?`;
      });
    });

    const btn_delete_no = document.querySelector("#modal-btn-no");

    btn_delete_no.addEventListener("click", (event) => {
      $("#modal-delete").modal("hide");
    });

    const btn_edit = document.querySelectorAll("#btn-edit");

    btn_edit.forEach((btn) => {
      btn.addEventListener("click", (event) => {
        document.querySelector("#form-pos").reset();
        const id = btn.getAttribute("data");

        axios
          .get(
            `http://${window.location.hostname}/erp_modulos/rh/Api/positions/${id}`
          )
          .then((response) => {
            reset();
            const data = response.data;
            singleValueSetter(data);
            const supervisor = parseInt(response.data.positionIsSupervisor);
            const label = document.querySelector("#submit-label");
            label.innerHTML = `Editar ${name}`;
            const input = document.querySelector("#positionName");
            $("#positionDepartment").selectpicker("refresh");
            const check = document.querySelector("#positionIsSupervisor");
            check.checked = supervisor;
            $("#positionName").popover("dispose");
            input.classList.remove("is-invalid");
            submit.setAttribute("data-method", "edit");
            form.setAttribute("data", id);
          })
          .catch((e) => {
            console.log(e);
          });
      });
    });

    $('#schedule input[type="text"]').datetimepicker({
      format: "HH:mm",
      stepping: 30,
      icons: {
        up: "fas fa-chevron-up",
        down: "fas fa-chevron-down",
      },
    });

    document.querySelectorAll('[data-util="add-turn"]').forEach((add) => {
      const target = add.getAttribute("data-target");

      $(`[data-target="${target}"]`)
        .attr("data-original-title", "Añadir turno")
        .tooltip();

      $(`[data-target="${target}"]`).on("click", () => {
        if ($(`[data-target="${target}"]`).attr("aria-expanded") === "false") {
          $(`[data-target="${target}"]`)
            .attr("data-original-title", "Eliminar turno")
            .tooltip("update")
            .tooltip("show");
          $(`[data-target="${target}"]`)
            .closest(".collapse")
            .prev("div")
            .find("button")
            .prop("disabled", true);
        } else {
          $(`[data-target="${target}"]`)
            .attr("data-original-title", "Añadir turno")
            .tooltip("update")
            .tooltip("show");
          $(`${target} input`).val("");
          $(`[data-target="${target}"]`)
            .closest(".collapse")
            .prev("div")
            .find("button")
            .prop("disabled", false);
        }
      });
    });

    document.querySelectorAll("#days .day").forEach((d) => {
      d.querySelectorAll(".form-row").forEach((t) => {
        const idFrom = t.querySelectorAll("input")[0].getAttribute("id");
        const idTo = t.querySelectorAll("input")[1].getAttribute("id");

        $(`#${idFrom}`)
          .datetimepicker()
          .on("dp.change", function (e) {
            $(`#${idTo}`).data("DateTimePicker").minDate(e.date);
          });

        $(`#${idTo}`)
          .datetimepicker({
            useCurrent: false,
          })
          .on("dp.change", function (e) {
            $(`#${idFrom}`).data("DateTimePicker").maxDate(e.date);
          });
      });
    });

    const days = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado']

    const multi_options = days.map(day => (`<option>${day}</option>`))

    /*document.querySelector("#multi-select").innerHTML = multi_options.join('')
    $('#multi-select').selectpicker('refresh')

    const multi = document.querySelector("#multiselector");

    multi.addEventListener("click", event => {
      if (multi.checked == true) {
        document.querySelector("#days-select-bar").hidden = true;
        $('#multi').collapse("show")
      } else {
        document.querySelector("#days-select-bar").hidden = false;
        $('#multi').collapse("hide")
      }
    });*/
  },
  true
);
