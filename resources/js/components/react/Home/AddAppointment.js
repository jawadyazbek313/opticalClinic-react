import React, { useEffect, useState } from "react";
import { createRoot } from "react-dom/client";
import {
    Autocomplete,
    Box,
    Button,
    TextField,
    Typography,
} from "@mui/material";
import axios from "axios";
import { debounce } from "lodash";

export default function AddAppointment() {
    const [options, setOptions] = useState([]);
    const [isLoading, setisLoading] = useState(false);
    const [value, setValue] = useState();
    const [inputValue, setInputValue] = useState("");
    const [searchQuery, setSearchQuery] = useState("");

    useEffect(() => {
        setisLoading(true);
        axios
            .get("/api/GetSelectPatient", {
                params: {
                    searchQuery: inputValue,
                },
            })
            .then((results) => {
                setOptions(results.data);
                setisLoading(false);
            })
            .catch((error) => {
                console.log(error);
            })
            .finally(() => {
                setisLoading(false);
            });
    }, [inputValue]);

    return (
        <>
            <Autocomplete
                
                fullWidth
                filterOptions={(x) => x}
                style={{ marginTop: 20 }}
                value={value}
                onChange={(event, newValue) => {
                    
                    setValue(newValue);
                    document.getElementById("patient_idjax").value =
                        newValue.id;
                }}
                loading={isLoading}
                onInputChange={debounce((event, newInputValue) => {
                    setInputValue(newInputValue);
                }, 500)}
                noOptionsText={
                    <>
                        <Typography marginBottom={2}>
                            No Patient Found with name
                            {" "}{inputValue}
                        </Typography>

                        <Button
                            fullWidth
                            variant="contained"
                            onClick={() => {
                                $("#addAppointment").modal("hide");
                                $.ajax({
                                    url: "/patient/create",
                                    success: function (data) {
                                        $("#ajaxgo").html(data);

                                        $("#myModal1").modal("show");
                                    },
                                });
                            }}
                        >
                            Add New Patient
                        </Button>
                    </>
                }
                isOptionEqualToValue={(option, value) =>
                    option.firstname === value.firstname
                }
                getOptionLabel={(option) =>
                    option.firstname +
                    " " +
                    option.midname +
                    " " +
                    option.lastname
                }
                renderOption={(props, option) => (
                    <Box component="li" {...props}>
                        {option.firstname} {option.midname} {option.lastname}{" "}
                        <Typography variant="caption"> {option.dob}</Typography>
                    </Box>
                )}
                id="controllable-states-demo"
                options={options}
                sx={{ width: 300 }}
                renderInput={(params) => (
                    <TextField {...params} label="Search For Patients" />
                )}
            />
        </>
    );
}
if (document.getElementById("AddAppointmentSelectInput")) {
    const root = createRoot(
        document.getElementById("AddAppointmentSelectInput")
    );
    root.render(<AddAppointment />);
}
