import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Entry } from '@app/shared/models/entry';
import { FormService } from '@app/shared/services/form.service';

@Component({
  selector: 'app-form',
  templateUrl: './new-form.component.html',
  styleUrls: ['./new-form.component.scss']
})
export class NewFormComponent implements OnInit {
  formId!: number;

  constructor(
    private readonly route: ActivatedRoute,
    private readonly router: Router,
    private readonly formService: FormService
  ) {
  }

  ngOnInit() {
    this.route.params.subscribe(params => {
      this.formId = +params['formId'];
      this.createFormEntry();
    });
  }

  createFormEntry() {
    this.formService.createFormEntry(this.formId).subscribe((entry: Entry) => {
      this.router.navigate(['forms', this.formId, 'edit', entry.id]);
    });
  }
}
