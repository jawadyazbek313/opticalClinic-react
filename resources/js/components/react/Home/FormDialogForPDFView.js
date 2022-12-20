import { Viewer, Worker } from "@react-pdf-viewer/core";
import React, { forwardRef, useState } from "react";

import "@react-pdf-viewer/core/lib/styles/index.css";
import Button from "@mui/material/Button";
import Dialog from "@mui/material/Dialog";
import ListItemText from "@mui/material/ListItemText";
import ListItem from "@mui/material/ListItem";
import List from "@mui/material/List";
import Divider from "@mui/material/Divider";
import AppBar from "@mui/material/AppBar";
import Toolbar from "@mui/material/Toolbar";
import IconButton from "@mui/material/IconButton";
import Typography from "@mui/material/Typography";
import CloseIcon from "@mui/icons-material/Close";
import Slide from "@mui/material/Slide";
import { defaultLayoutPlugin } from "@react-pdf-viewer/default-layout";

// Import styles
import "@react-pdf-viewer/default-layout/lib/styles/index.css";
import { Box, Grid } from "@mui/material";

const Transition = forwardRef(function Transition(props, ref) {
    return <Slide direction="up" ref={ref} {...props} />;
});

export default function FormDialogForPDFView(props) {
    const defaultLayoutPluginInstance = defaultLayoutPlugin();

    function handleClose() {
        props.setOpen(false);
    }
    return (
        <div>
            <Dialog
                fullScreen
                open={props.open}
                onClose={handleClose}
                TransitionComponent={Transition}
            >
                <AppBar sx={{ position: "relative" }}>
                    <Toolbar>
                        <IconButton
                            edge="start"
                            color="inherit"
                            onClick={handleClose}
                            aria-label="close"
                        >
                            <CloseIcon />
                        </IconButton>
                        <Typography
                            sx={{ ml: 2, flex: 1 }}
                            variant="h6"
                            component="div"
                        >
                            Last PDF
                        </Typography>
                    </Toolbar>
                </AppBar>
                {/* {console.log(props.CurrentFile)} */}
                {props.CurrentFile==null ? (
                    <>
                    <Box
  display="flex"
  justifyContent="center"
  alignItems="center"
  minHeight="100vh"
>
<div className="h1">No PDF</div>

</Box>
                      
                    </>
                ) : (
                    <Worker workerUrl="js/pdf.worker.min.js">
                        <Viewer
                            defaultScale={1}
                            plugins={[defaultLayoutPluginInstance]}
                            fileUrl={props.CurrentFile}
                        />
                    </Worker>
                )}
            </Dialog>
        </div>
    );
}
