import { React, useEffect, useState } from "react";
import Table from "@mui/material/Table";
import TableBody from "@mui/material/TableBody";
import TableCell from "@mui/material/TableCell";
import TableContainer from "@mui/material/TableContainer";
import Pagination from "@mui/material/Pagination";
import TableHead from "@mui/material/TableHead";
import TableRow from "@mui/material/TableRow";
import Paper from "@mui/material/Paper";
import axios from "axios";
import Skeleton from "react-loading-skeleton";
import "react-loading-skeleton/dist/skeleton.css";

import { debounce } from "lodash";
import {
    Backdrop,
    Box,
    Button,
    ButtonGroup,
    CircularProgress,
    FormControl,
    Input,
    InputLabel,
    OutlinedInput,
    TextField,
    Typography,
} from "@mui/material";
import UploadFilesFormDialog from "./UploadFilesFormDialog";
import FormDialogForPDFView from "./FormDialogForPDFView";
import FormDialogToSeeAllMedia from "./FormDialogToSeeAllMedia";

function createData(name, calories, fat, carbs, protein) {
    return { name, calories, fat, carbs, protein };
}

export default function UsersListWithShowFileAction(props) {
    const [refresh, setRefresh] = useState(false);
    const [CurrentFile, setCurrentFile] = useState("");
    const [numPages, setNumPages] = useState(null);
    const [pageNumber, setPageNumber] = useState(1);
    const [data, setData] = useState([]);
    const [searchQuery, setSearchQuery] = useState("");
    const [rows, setRows] = useState([]);
    const [page, setPage] = useState(1);
    const [isLoading, setIsLoading] = useState(false);
    const [open, setOpen] = useState(false);
    function DeleteFile(id) {
        axios.get("/api/DeleteFile",{
            params:{
                id:id
            }
        }).then((result)=>{
            setRefresh(!refresh);
        });
    }
    function setNewData(results) {
        setRows(results.data.data);
        setData(results.data);
    }

    function onDocumentLoadSuccess({ numPages }) {
        setNumPages(numPages);
    }

    const PatientsSearchQuery = debounce((event) => {
        setIsLoading(true);
        setPage(1);
        setSearchQuery(event.target.value);

        if (event.target.value != "") {
            axios
                .get(
                    "api/patients?page=" +
                        page +
                        "" +
                        (typeof props.todayPatients !== "undefined"
                            ? "&todayPatients=true"
                            : "") +
                        "&searchQuery=" +
                        event.target.value,
                    {}
                )
                .then((results) => {
                    // console.log(results);
                    setNewData(results);
                    setIsLoading(false);
                });
        } else if (event.target.value == "") {
            axios
                .get(
                    "api/patients?page=" +
                        page +
                        "" +
                        (typeof props.todayPatients !== "undefined"
                            ? "&todayPatients=true"
                            : ""),
                    {}
                )
                .then((results) => {
                    // console.log(results);
                    setIsLoading(false);
                    setNewData(results);
                });
        }
    }, 500);
    // todo: fix count and do loading + search
    useEffect(() => {
        setIsLoading(true);
        if (searchQuery == "") {
            axios
                .get(
                    "api/patients?page=" +
                        page +
                        "" +
                        (typeof props.todayPatients !== "undefined"
                            ? "&todayPatients=true"
                            : "")
                )
                .then((results) => {
                    // console.log(results);
                    setTimeout(() => {
                        setNewData(results);
                        setIsLoading(false);
                    }, 500);
                });
        } else {
            axios
                .get(
                    "api/patients?searchQuery=" +
                        searchQuery +
                        "&page=" +
                        page +
                        "" +
                        (typeof props.todayPatients !== "undefined"
                            ? "&todayPatients=true"
                            : "")
                )
                .then((results) => {
                    // console.log(results);
                    setTimeout(() => {
                        setNewData(results);
                        setIsLoading(false);
                    }, 500);
                });
        }
    }, [page, refresh]);

    function ShowLastFile(e) {
        // console.log(e.target.dataset.user_id);
        axios
            .get("api/PatientgetLastPDF", {
                params: {
                    patient_id: e.target.dataset.user_id,
                },
            })
            .then((result) => {
                setCurrentFile(result.data);
                setOpen(true);
                // console.log(result.data);
            });
    }
    return (
        <>
            {open && (
                <>
                    <FormDialogForPDFView
                        CurrentFile={CurrentFile}
                        open={open}
                        setOpen={setOpen}
                    />
                </>
            )}

            {/* {isLoading && (
                <>
                    <Backdrop
                        sx={{
                            color: "#fff",
                            zIndex: (theme) => theme.zIndex.drawer + 1,
                        }}
                        open={open}
                    >
                        <CircularProgress color="inherit" />
                    </Backdrop>
                </>
            )} */}
            <TableContainer component={Paper}>
                <Table
                    stickyHeader
                    aria-label="sticky table"
                    sx={{ minWidth: 650 }}
                >
                    <TableHead>
                        <TableRow>
                            <TableCell colSpan={12}>
                                <FormControl fullWidth>
                                    <InputLabel htmlFor="component-outlined">
                                        Search For Patients
                                    </InputLabel>
                                    <OutlinedInput
                                        id="component-outlined"
                                        name="searchForPatients"
                                        onChange={PatientsSearchQuery}
                                        label="Search For Patients"
                                    />
                                </FormControl>
                            </TableCell>
                        </TableRow>
                        <TableRow>
                            <TableCell>ID</TableCell>
                            <TableCell align="center">Name</TableCell>
                            <TableCell align="center">Date Of Birth</TableCell>
                            <TableCell align="center">Insurance</TableCell>
                            <TableCell align="center">Actions</TableCell>
                        </TableRow>
                    </TableHead>
                    <TableBody style={{ height: "452.5px" }}>
                        {isLoading ? (
                            <>
                                <TableRow className="text-center m-0 p-0">
                                    <TableCell colSpan={12} className="">
                                        <Skeleton
                                            style={{ margin: 0, padding: 0 }}
                                            height={"59.8px"}
                                            count={5}
                                        />
                                    </TableCell>
                                </TableRow>
                            </>
                        ) : rows.length < 1 ? (
                            <>
                            <TableRow className="text-center m-0 p-0">
                                    <TableCell colSpan={12} className="">
                                    <Box
                                display="flex"
                                justifyContent="center"
                                alignItems="center"
                                minHeight="100%"
                            >
                                <Typography variant="h4">All Patients Are Examined !</Typography>
                            </Box>
                                    </TableCell>
                                </TableRow></>
                           
                        ) : (
                            rows.map((row) => (
                                <TableRow
                                    key={row.id}
                                    sx={{
                                        "&:last-child td, &:last-child th": {
                                            border: 0,
                                        },
                                    }}
                                >
                                    <TableCell component="th" scope="row">
                                        {row.id}
                                    </TableCell>
                                    <TableCell
                                        onMouseOver={(e) => {
                                            this.e.style.cursor = "pointer";
                                        }}
                                        onClick={() => {
                                            window.location.href =
                                                "/patient/" + row.id;
                                        }}
                                        align="center"
                                    >
                                        <Typography>
                                            {(!!row.firstname
                                                ? row.firstname
                                                : "") +
                                                " " +
                                                (!!row.midname
                                                    ? row.midname
                                                    : "") +
                                                " " +
                                                (!!row.lastname
                                                    ? row.lastname
                                                    : "")}
                                        </Typography>
                                    </TableCell>
                                    <TableCell align="center">
                                        {row.dob}
                                    </TableCell>
                                    <TableCell align="center">
                                        {row.insurance}
                                    </TableCell>
                                    <TableCell align="center">
                                        <ButtonGroup
                                            variant="contained"
                                            aria-label="outlined primary button group"
                                        >
                                            <Button
                                                disabled={
                                                    row.media_manually_count > 0
                                                        ? false
                                                        : true
                                                }
                                                data-user_id={row.id}
                                                onClick={ShowLastFile}
                                            >
                                                <i className="fas fa-file-pdf mr-1"></i>
                                                Last File
                                            </Button>

                                            <FormDialogToSeeAllMedia
                                            DeleteFile={DeleteFile}
                                                data={row.media_manually}
                                                setCurrentFile={setCurrentFile}
                                                setOpenPDFViewer={setOpen}
                                            />
                                            <UploadFilesFormDialog
                                                setOpenPDFViewer={setOpen}
                                                setCurrentFile={setCurrentFile}
                                                refresh={refresh}
                                                setRefresh={setRefresh}
                                                patient_id={row.id}
                                            />
                                        </ButtonGroup>
                                    </TableCell>
                                </TableRow>
                            ))
                        )}

                        <TableRow
                            className="text-center"
                            style={{ height: "72px" }}
                        >
                            <TableCell colSpan={12} className="min-w-full">
                                <Pagination
                                    count={data.last_page}
                                    color="primary"
                                    style={{
                                        padding: 20,
                                        width: "100%",
                                        display: "flex",
                                        justifyContent: "center",
                                        direction: "intial !important",
                                    }}
                                    page={page}
                                    onChange={(_, value) => {
                                        setPage(value);
                                    }}
                                />
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </TableContainer>
        </>
    );
}
