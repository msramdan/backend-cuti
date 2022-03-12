<script>
    function checkMinAndMaxLength(index) {
        let dataType = $(`.form-data-types:eq(${index})`).val()
        let minLength = $(`.form-min-lengths:eq(${index})`)
        let maxLength = $(`.form-max-lengths:eq(${index})`)

        if (
            dataType == 'string' ||
            dataType == 'text' ||
            dataType == 'longText' ||
            dataType == 'tinyText' ||
            dataType == 'varchar' ||
            dataType == 'char'
        ) {
            minLength.prop('readonly', false)
            maxLength.prop('readonly', false)
        } else {
            minLength.prop('readonly', true)
            maxLength.prop('readonly', true)
            minLength.val('')
            maxLength.val('')
        }
    }

    function removeAllInputHidden(index) {
        $(`#tbl-field tbody tr:eq(${index}) td:eq(2) .form-option`).remove()
        $(`#tbl-field tbody tr:eq(${index}) td:eq(2) .form-constrain`).remove()
        $(`#tbl-field tbody tr:eq(${index}) td:eq(2) .form-foreign-id`).remove()

        removeInputTypeHidden(index)
    }

    function removeInputTypeHidden(index) {
        $(`#tbl-field tbody tr:eq(${index}) td:eq(4) .form-file-types`).remove()
        $(`#tbl-field tbody tr:eq(${index}) td:eq(4) .form-file-sizes`).remove()
        $(`#tbl-field tbody tr:eq(${index}) td:eq(4) .form-mimes`).remove()
    }

    function addInputTypeHidden(index) {
        $(`#tbl-field tbody tr:eq(${index}) td:eq(4)`).append(
            `<input type="hidden" name="file_types[]" class="form-file-types">
                    <input type="hidden" name="files_sizes[]" class="form-file-sizes">
                    <input type="hidden" name="mimes[]" class="form-mimes">`
        )
    }

    function addDataTypeHidden(index) {
        $(`#tbl-field tbody tr:eq(${index}) td:eq(2)`).append(`
            <input type="hidden" name="select_options[]" class="form-option">
            <input type="hidden" name="constrains[]" class="form-constrain">
            <input type="hidden" name="foreign_ids[]" class="form-foreign-id">
        `)
    }

    function renderTypes() {
        let optionTypes = ''

        $(types).each(function(i, val) {
            optionTypes += `<option value="${val}">${capitalizeFirstLetter(val)}</option>`
        })

        return optionTypes
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1)
    }

    function generateNo() {
        let no = 1

        $('#tbl-field tbody tr').each(function() {
            $(this).find('td:nth-child(1)').html(no)
            no++
        })
    }
</script>
