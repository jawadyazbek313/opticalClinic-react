import { Grid, IconButton, ListItem } from "@mui/material";
import DeleteForeverIcon from "@mui/icons-material/DeleteForever";
import VisibilityIcon from "@mui/icons-material/Visibility";
import React, { useEffect, useState } from "react";
import Swal from 'sweetalert2'
export default function FilesListItem(props) {
    const [fileUrl, setFileUrl] = useState("");
    useEffect(() => {
        setFileUrl(props.data.original_url);
    }, []);

    return (
        <>
            <ListItem>
                <Grid
                    container
                    spacing={1}
                    alignContent={"center"}
                    alignItems={"center"}
                >
                    <Grid xs={6} item>
                        {props.data.name}
                    </Grid>
                    <Grid xs={2} item>
                        {props.data.size < 1048576
                            ? (props.data.size / 1024).toFixed(2) + "KB"
                            : (props.data.size / 1024 / 1024).toFixed(2) + "MB"}
                    </Grid>
                    <Grid xs={2} item>
                        {" "}
                        {new Date(props.data.created_at).toLocaleString("en-US")}
                    </Grid>
                    <Grid xs={2} item alignItems={"center"}>
                        <IconButton
                            onClick={() => {
                                props.handleListItemClick(fileUrl);
                            }}
                        >
                            <VisibilityIcon color="primary" />
                        </IconButton>
                        <IconButton
                            onClick={() => {3
                                props.onClose;
                                Swal.fire({
                                    
                                    title: 'Pressing delete will delete the file forever',
                                    showCancelButton: true,
                                    confirmButtonText: 'Delete',
                                 
                                  }).then((result) => {
                                    /* Read more about isConfirmed, isDenied below */
                                    if (result.isConfirmed) {
                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: 'bottom',
                                            showConfirmButton: false,
                                            timer: 3000,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                              toast.addEventListener('mouseenter', Swal.stopTimer)
                                              toast.addEventListener('mouseleave', Swal.resumeTimer)
                                            }
                                          })
                                          
                                          Toast.fire({
                                            icon: 'success',
                                            title: 'Deleted Successfully'
                                          })
                                      props.DeleteFile(props.data.id);
                                    } else if (result.isDenied) {
                                      Swal.fire('Changes are not saved', '', 'info')
                                    }
                                  })
                                
                            }}
                        >
                            <DeleteForeverIcon color="error" width={10} />
                        </IconButton>
                    </Grid>
                </Grid>
            </ListItem>
        </>
    );
}
