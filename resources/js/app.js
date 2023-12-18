import './bootstrap';
import flatpickr from "flatpickr";
import Quill from "quill";
import * as FilePond from "filepond";
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
import { createPopper } from "@popperjs/core";
import { Tooltip, Select, initTE } from "tw-elements";

initTE({ Select, Tooltip });

window.Select = Select;
window.Tooltip = Tooltip;

FilePond.registerPlugin(FilePondPluginImagePreview);
FilePond.registerPlugin(FilePondPluginFileValidateType);
FilePond.registerPlugin(FilePondPluginFileValidateSize);

window.flatpickr = flatpickr;
window.FilePond = FilePond;
window.Quill = Quill;
window.createPopper = createPopper;
