import { router, usePage } from "@inertiajs/react";
import { useState } from "react";
import { useRoute } from "ziggy-js";

const Create = () => {
    const { errors } = usePage().props;
    const route = useRoute();

    const handleNewSupportCreate = (e) => {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);

        router.post(route("supports.store"), formData);
    };

    return (
        <section>
            <h1>Nova Dúvida</h1>

            {errors &&
                Object.values(errors).map((error) => {
                    return (
                        <p key={error} style={{ color: "red" }}>
                            {error}
                        </p>
                    );
                })}

            <form method="post" onSubmit={handleNewSupportCreate}>
                <label htmlFor="subject">Assunto:</label>
                <input type="text" name="subject" id="subject" />

                <label htmlFor="body">Descrição:</label>
                <textarea name="body" id="body" cols="30" rows="5"></textarea>

                <button type="submit">Enviar</button>
            </form>
        </section>
    );
};

export default Create;
