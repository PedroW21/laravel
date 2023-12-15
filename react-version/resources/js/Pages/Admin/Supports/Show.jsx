import { usePage } from "@inertiajs/react";
import React from "react";

const Show = () => {
    const { support } = usePage().props;
    const { id, subject, status, body } = support;

    return (
        <section>
            <h1>Detalhes da dúvida #{id}</h1>

            <ul>
                <li>Assunto: {subject}</li>
                <li>Status: {status}</li>
                <li>Descrição: {body}</li>
            </ul>
        </section>
    );
};

export default Show;
