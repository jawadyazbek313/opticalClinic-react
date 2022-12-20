import { React, useState } from "react";
import Button from "@mui/material/Button";
import TextField from "@mui/material/TextField";
import Dialog from "@mui/material/Dialog";
import DialogActions from "@mui/material/DialogActions";
import DialogContent from "@mui/material/DialogContent";
import DialogContentText from "@mui/material/DialogContentText";
import DialogTitle from "@mui/material/DialogTitle";
import { FormLabel, Input } from "@mui/material";
// Import React FilePond
import { FilePond, registerPlugin } from "react-filepond";
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';

// Import FilePond styles
import "filepond/dist/filepond.min.css";

// Import the Image EXIF Orientation and Image Preview plugins
// Note: These need to be installed separately
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

// Register the plugins
registerPlugin(FilePondPluginImageExifOrientation, FilePondPluginImagePreview,FilePondPluginFileValidateType);


export default function UploadFilesFormDialog(props) {
    const [open, setOpen] = useState(false);
    const [files, setFiles] = useState([]);
    const handleClickOpen = () => {
        setOpen(true);
    };
    const refresh = () => {props.setRefresh(!props.refresh) }
    const handleClose = () => {
        setOpen(false);
        setFiles([]);
    };
const ClearFiles = () => {
    setFiles([]);
}
    return (
        <>
            <Button onClick={handleClickOpen}>
                <i className="fas fa-upload mr-1"></i>
            </Button>
            <Dialog fullWidth open={open} onClose={handleClose}>
                <DialogTitle>Upload PDF</DialogTitle>
                <DialogContent>
                <FilePond
                    acceptedFileTypes={["application/pdf"]}
                    allowImagePreview={true}
                    onprocessfile={refresh}
                    server={"api/UploadFiles?patient_id="+props.patient_id}
                    name="files"
                    labelIdle='Drag & Drop your files or <span class="filepond--label-action">Browse</span>'
                    fileValidateTypeDetectType={true}
                   
                    
      />
                </DialogContent>
                <DialogActions>
                    <Button onClick={handleClose}>Cancel</Button>
                </DialogActions>
            </Dialog>
        </>
    );
}
