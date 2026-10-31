/**
 * Progressive enhancement for inquiry forms: the form posts normally; this
 * only prevents double submission and keeps a short "sending" state.
 */
export default () => ({
    sending: false,

    submit(event) {
        if (this.sending) {
            event.preventDefault();
            return;
        }

        this.sending = true;
    },
});
