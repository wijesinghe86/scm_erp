import { toast } from 'react-toastify';


export function captureErrors(error) {
    if (error.isAxiosError || error.name === "AxiosError") {
        if (
            error.response?.data?.errors &&
            Object?.keys(error.response?.data?.errors)?.length > 0
        ) {
            const errorList = error.response?.data?.errors;
            Object.values(errorList)?.map((row) => {
                toast.error(row[0]);
            });
        }
    } else {
        console.log(error);
    }
}
