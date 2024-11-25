const fileInput = $("#dragDrop");
const dragArea = $("#dragArea");
const imagePreview = $("#imagePreview");

dragArea.on("mousedown", (e) => {
    const target = $(e.target);
    if (!target.is("figure") && !target.is("img") && !target.is("i")) {
        fileInput[0].click();
    }
});

function preventDefault(event) {
    event.preventDefault();
    event.stopPropagation();
}

dragArea.on("dragenter dragleave dragover drop", preventDefault);

dragArea.on("drop", (event) => {
    let files = event.originalEvent.dataTransfer.files;
    checkFileType(files);
});

fileInput.on("change", () => {
    let files = fileInput[0].files;
    checkFileType(files);
});

function checkFileType(files) {
    let validTypes = ["image/jpeg", "image/jpg", "image/png", "image/webp"];
    $.each(files, (index, file) => {
        let fileType = file.type;

        if (validTypes.includes(fileType)) {
            displayImage(file, index);
        }
    });
}

function displayImage(image, index) {
    imagePreview.css("display", "block");

    let figure = $("<figure>");
    let img = $("<img>");
    let span = $("<span>");

    span.append('<i class="fa-solid fa-xmark"></i>');
    figure.append(span);
    figure.append(img);
    imagePreview.append(figure);

    span.on("click", removeImage);

    let fileReader = new FileReader();

    fileReader.onload = (event) => {
        img.attr("src", URL.createObjectURL(image));
        img.attr("data-index", index);
        img.attr("href", URL.createObjectURL(image));
        img.attr("data-featherlight", "image");
    };

    fileReader.readAsDataURL(image);
}

function removeImage(event) {
    event.stopPropagation();
    let deletedImage = $(event.currentTarget).closest('figure');
    deletedImage.addClass("zoomOut");

    setTimeout(() => {
        deletedImage.remove();
        let dt = new DataTransfer()
        let deletedFileIndex = $('img', deletedImage).data("index");
        let fileInput = $("#dragDrop")[0];
        const { files } = fileInput
        for (let i = 0; i < files.length; i++) {
            const file = files[i]
            if (deletedFileIndex !== i)
                dt.items.add(file)
        }
        fileInput.files = dt.files
        if (imagePreview.children().length == 0) {
            imagePreview.css("display", "none");
        }
    }, 450);
}
