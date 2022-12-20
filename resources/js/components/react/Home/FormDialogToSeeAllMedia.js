import React, { useState } from "react";
import PropTypes from "prop-types";
import Button from "@mui/material/Button";
import Avatar from "@mui/material/Avatar";
import List from "@mui/material/List";
import ListItem from "@mui/material/ListItem";
import ListItemAvatar from "@mui/material/ListItemAvatar";
import ListItemText from "@mui/material/ListItemText";
import DialogTitle from "@mui/material/DialogTitle";
import Dialog from "@mui/material/Dialog";
import PersonIcon from "@mui/icons-material/Person";

import AddIcon from "@mui/icons-material/Add";
import Typography from "@mui/material/Typography";
import { blue } from "@mui/material/colors";
import { Grid } from "@mui/material";
import FilesListItem from "./FilesListItem";

const emails = ["username@gmail.com", "user02@gmail.com"];

function SimpleDialog(props) {
    const { onClose, open,data,setCurrentFile,setOpenPDFViewer } = props;
    const handleClose = () => {
        onClose();
    };

    const handleListItemClick = (file) => {
        // console.log(file)
        // console.log(data[e.target.getAttribute("data-index")].original_url);
        setCurrentFile(file);
        props.setOpenPDFViewer(true);
    };

    return (
        <Dialog fullWidth maxWidth={"lg"} onClose={handleClose} open={open}>
            <DialogTitle>Select The File you want to Open</DialogTitle>

            <List sx={{ pt: 0 }}>
                <ListItem disabled style={{ color: "black" }}>
                    <Grid sx={{ pt: 0 }} container spacing={1}>
                        <Grid xs={6} item>
                            Name
                        </Grid>
                        <Grid xs={2} item>
                            Size
                        </Grid>
                        <Grid xs={2} item>
                            Upload Date
                        </Grid>
                        <Grid xs={2} item>
                            Action
                        </Grid>
                    </Grid>
                </ListItem>
                {data.map((row) => (
                 
                  <FilesListItem
                  DeleteFile={props.DeleteFile}
                  onClose={onClose}
                  key={row.uuid} data={row} handleListItemClick={handleListItemClick} />
                ))}
            </List>
        </Dialog>
    );
}

export default function FormDialogToSeeAllMedia(props) {
    const [open, setOpen] = useState(false);

    const handleClickOpen = async () => {
        setOpen(true);
    };

    const handleClose = () => {
        setOpen(false);
    };

    return (
        <>
            <Button onClick={handleClickOpen}><i className="fas fa-folder-open mr-1"></i> All Files</Button>
            <SimpleDialog
            DeleteFile={props.DeleteFile}
                setOpenPDFViewer={props.setOpenPDFViewer}
                setCurrentFile={props.setCurrentFile}
                data={props.data}
                open={open}
                onClose={handleClose}
            />
        </>
    );
}
