import {Component, Inject, OnInit} from '@angular/core';
import {MAT_DIALOG_DATA} from '@angular/material/dialog';
import {ModalInput} from './modal-input.model';

@Component({
    selector: 'app-modal',
    templateUrl: './modal.component.html',
    styleUrls: ['./modal.component.scss']
})
export class ModalComponent implements OnInit {
    title!: string;
    content!: string;

    constructor(
        @Inject(MAT_DIALOG_DATA)
        private readonly data: ModalInput,
    ) {
    }

    ngOnInit(): void {
        this.title = this.data.title;
        this.content = this.data.content;
    }
}
