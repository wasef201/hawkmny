(()=>{"use strict";var t,n,e,o=(t=document.getElementById("kt_modal_update_role"),n=t.querySelector("#kt_modal_update_role_form"),e=new bootstrap.Modal(t),{init:function(){!function(){t.querySelector('[data-kt-users-modal-action="close"]').addEventListener("click",(function(t){t.preventDefault(),Swal.fire({text:"Are you sure you would like to cancel?",icon:"warning",showCancelButton:!0,buttonsStyling:!1,confirmButtonText:"Yes, cancel it!",cancelButtonText:"No, return",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-active-light"}}).then((function(t){t.value?(n.reset(),e.hide()):"cancel"===t.dismiss&&Swal.fire({text:"Your form has not been cancelled!.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})}))})),t.querySelector('[data-kt-users-modal-action="cancel"]').addEventListener("click",(function(t){t.preventDefault(),Swal.fire({text:"Are you sure you would like to cancel?",icon:"warning",showCancelButton:!0,buttonsStyling:!1,confirmButtonText:"Yes, cancel it!",cancelButtonText:"No, return",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-active-light"}}).then((function(t){t.value?(n.reset(),e.hide()):"cancel"===t.dismiss&&Swal.fire({text:"Your form has not been cancelled!.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})}))}));var o=t.querySelector('[data-kt-users-modal-action="submit"]');o.addEventListener("click",(function(t){t.preventDefault(),o.setAttribute("data-kt-indicator","on"),o.disabled=!0,setTimeout((function(){o.removeAttribute("data-kt-indicator"),o.disabled=!1,Swal.fire({text:"Form has been successfully submitted!",icon:"success",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}}).then((function(t){t.isConfirmed&&e.hide()}))}),2e3)}))}()}});KTUtil.onDOMContentLoaded((function(){o.init()}))})();